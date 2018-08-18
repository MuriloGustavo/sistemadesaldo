<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array
    {
    	DB::beginTransaction();

    	$totalBefore = $this->amount ? $this->amount : 0;
    	$this->amount += number_format($value, 2 , '.', '');
    	$deposit = $this->save();

    	$historic = auth()->user()->historics()->create([
    		'type'			=> 'I',
    		'amount' 		=> $value,
    		'total_berofe' 	=> $totalBefore,
    		'total_after'	=> $this->amount,
    		'date'			=> date('Ymd')
    	]);

    	if($deposit && $historic){

    		DB::commit();

    		return [
    			'success' => true,
    			'message' => 'Sucesso ao recarregar'
    		];
    	}

    	else
    	{	

    		DB::roolback();

    		return [
    			'success' => false,
    			'message' => 'Falha ao recarregar'
    		];
    	}
    }

    public function withdraw(float $value) : Array
    {
        if($this->amount < $value)
        {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente'
            ];
        }

        DB::beginTransaction();

        $totalBefore = $this->amount;
        $this->amount -= number_format($value, 2 , '.', '');
        $withdraw = $this->save();

        $historic = auth()->user()->historics()->create([
            'type'          => 'O',
            'amount'        => $value,
            'total_berofe'  => $totalBefore,
            'total_after'   => $this->amount,
            'date'          => date('Ymd')
        ]);

        if($withdraw && $historic){

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao sacar'
            ];
        }

        else
        {   

            DB::roolback();

            return [
                'success' => false,
                'message' => 'Falha ao sacar'
            ];
        }
    }

    public function transfer(float $value, User $sender) : Array
    {
        if($this->amount < $value)
        {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente'
            ];
        }

        DB::beginTransaction();

        /************************************************
        * Atualiza o proprio Saldo
        ************************************************/
        $totalBefore = $this->amount;
        $this->amount -= number_format($value, 2 , '.', '');
        $transfer = $this->save();

        $historic = auth()->user()->historics()->create([
            'type'                  => 'T',
            'amount'                => $value,
            'total_berofe'          => $totalBefore,
            'total_after'           => $this->amount,
            'user_id_transaction'   => $sender->id,
            'date'                  => date('Ymd')
        ]);

        /************************************************
        * Atualiza o proprio Saldo
        ************************************************/
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += number_format($value, 2 , '.', '');
        $transferSender = $senderBalance->save();

        $historicSender = $sender->historics()->create([
            'type'                  => 'I',
            'amount'                => $value,
            'total_berofe'          => $totalBeforeSender,
            'total_after'           => $senderBalance->amount,
            'user_id_transaction'   => auth()->user()->id,
            'date'                  => date('Ymd')
        ]);

        if($transfer && $historic && $transferSender &&  $historicSender)
        {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao transferir'
            ];
        }

        DB::roolback();

        return [
            'success' => false,
            'message' => 'Falha ao transferir'
        ];
    }
}
