<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestAnswer extends Model
{
    protected $table = 'best_answers'; // テーブル名を指定
    protected $fillable = ['comment_id']; // テーブルのカラムを指定
}
