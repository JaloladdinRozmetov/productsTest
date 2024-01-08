<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Support\Facades\Notification;


class SendProductCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $product;

    public function __construct($email,Product $product)
    {
        $this->email = $email;
        $this->product = $product;
    }

    /**
     * @return void
     */
    public function handle(): void
    {

        Notification::route('mail', $this->email)
            ->notify(new ProductCreatedNotification($this->product));
    }
}
