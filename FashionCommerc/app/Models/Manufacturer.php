<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_manufacturer';

    protected $fillable = [
        'name_manufacturer',
        'image_manufacturer',
    ];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class, 'id_manufacturer');
    }

    // Query Methods
    public static function getManufacturersWithPagination($perPage = 2)
    {
        return self::paginate($perPage);
    }

    public static function getAllManufacturers()
    {
        return self::all();
    }

    public static function findManufacturerById($id)
    {
        return self::findOrFail($id);
    }

    public static function createManufacturer($data)
    {
        return self::create([
            'name_manufacturer' => $data['name_manufacturer'],
            'image_manufacturer' => $data['image_manufacturer'],
        ]);
    }

    public static function updateManufacturerById($id, $data)
    {
        $manufacturer = self::findManufacturerById($id);
        if ($manufacturer) {
            $manufacturer->name_manufacturer = $data['name_manufacturer'];
            if (isset($data['image_manufacturer'])) {
                $manufacturer->image_manufacturer = $data['image_manufacturer'];
            }
            $manufacturer->save();
            return $manufacturer;
        }
        return null;
    }
}
