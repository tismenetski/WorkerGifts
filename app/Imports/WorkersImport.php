<?php

namespace App\Imports;

use App\Models\Giftcard;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;




class WorkersImport implements ToCollection, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {


        Validator::make($rows->toArray(), [
            '*.id' => 'required',
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.position' => 'required',
            '*.department' => 'required',
            '*.work_start_date' => 'required',
            '*.email' => 'required',
            '*.gift_card' => 'required|numeric|min:300|max:1000'
        ])->validate();

        foreach ($rows as $row) {
            $user = User::create([
                'name' => $row['first_name'] ." ".  $row['last_name'],
                'email' => $row['email'],
                'password' => bcrypt($row['first_name'] . $row['last_name']),
            ]);

            $user->save();

            $worker = Worker::create([

                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'position' => $row['position'],
                'department' => $row['department'],
                'work_start_date' => date('Y-m-d', strtotime($row['work_start_date'])),
            ]);

            $worker->save();

            $gift_card = Giftcard::create([

                'valid_until' => '2025-01-01',
                'issued_at' => now(),
                'amount' => $row['gift_card']
            ]);

            $gift_card->save();

            $worker->user_id = $user->id;
            $gift_card->worker_id = $worker->id;

            $worker->save();
            $gift_card->save();

        }
    }
}
