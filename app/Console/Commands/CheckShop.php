<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
class CheckShop extends Command
{
    /**
     * nama dan argumen perintah yang akan dijalankan di terminal
     * kita tambahkan argumen opsional {jam?} untuk mengecek status
     */
    protected $signature = 'pos:check {jam?}';

    /**
     * deskripsi perintah saat dilihat melalui 'php artisan list'
     * 
     */
    protected $signature = 'pos:check {jam?}';
    