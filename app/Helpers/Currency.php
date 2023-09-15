<?php
namespace App\Helpers;

use NumberFormatter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Currency{

    public static function format($amount,$currency=null) {
        // $locale = config('app.locale');
        // $currency = config('app.currency', 'USD');
        // $formatter = new NumberFormatter($locale,NumberFormatter::CURRENCY);

        // $formattedCurrency = $formatter->formatCurrency($amount, $currency);

        // return  $formattedCurrency;

        $baseCurrency = config('app.currency', 'USD');

        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        if ($currency === null) {
            $currency = Session::get('currency_code', $baseCurrency);
        }

        if ($currency != $baseCurrency) {
            $rate = Cache::get('currency_rate_' . $currency, 1);
            $amount = $amount * $rate;
        }

        return $formatter->formatCurrency($amount, $currency);

    }
}
