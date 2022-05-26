<?php
namespace App\Repository\Promotion;

use Illuminate\Http\Request;

interface PromotionInterface
{

    // All Promotions ( index )
    public function allPromotions();

    // Store Promotion
    public function storePromotion(Request $request);
}
