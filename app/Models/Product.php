<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'image_url',
        '_id',
    ];

    /**
     * Checks if these products are in the database.
     *
     * @param array $data
     * @return array
     */
    public static function checkExists(array $data): array
    {
        $products = $data['products'];

        $saved = self::whereIntegerInRaw('_id', collect($products)->pluck('_id'))->get();

        foreach ($saved as $item) {
            foreach ($products as $key => $product) {
                if ($item->_id === (int)$product['_id']) {
                    $products[$key]['saved'] = true;
                }
            }
        }

        $data['products'] = $products;

        return $data;
    }
}
