<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_category',
        'id_manufacturer',
        'name_product',
        'quantity_product',
        'price_product',
        'image_address_product',
        'describe_product',
        'specifications',
        'sizes',
        'colors',
        'purchased' 
    ];

    // Validation rules
    public static $rules = [
        'name_product' => 'required|max:100|regex:/^[^<>]*$/',
        'quantity_product' => 'required|integer|min:0|max:999999',
        'price_product' => 'required|numeric|min:0|max:999999999',
        'sizes' => ['required', 'regex:/^[a-zA-Z0-9\s,]{1,10}$/', 'max:10'],
        'image_address_product' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'describe_product' => 'required|max:500|regex:/^[^<>]*$/',
        'id_category' => 'required|exists:categories,id_category',
        'id_manufacturer' => 'required|exists:manufacturers,id_manufacturer',
        'specifications' => 'nullable|max:500|regex:/^[^<>]*$/',
        'colors' => 'nullable|string|regex:/^[a-zA-Z0-9\s,ÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮĐàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữđ]*$/|max:50'
    ];

    // Custom error messages
    public static $messages = [
        'name_product.required' => 'Tên sản phẩm không được để trống',
        'name_product.max' => 'Tên sản phẩm không được vượt quá 100 ký tự',
        'name_product.regex' => 'Tên sản phẩm không được chứa ký tự đặc biệt',
        'quantity_product.required' => 'Số lượng không được để trống',
        'quantity_product.integer' => 'Số lượng phải là số nguyên',
        'quantity_product.min' => 'Số lượng không được nhỏ hơn 0',
        'quantity_product.max' => 'Số lượng không được vượt quá 999999',
        'price_product.required' => 'Giá không được để trống',
        'price_product.numeric' => 'Giá phải là số',
        'price_product.min' => 'Giá không được nhỏ hơn 0',
        'price_product.max' => 'Giá không được vượt quá 999999999',
        'sizes.required' => 'Kích thước không được để trống',
        'sizes.regex' => 'Kích thước chỉ được chứa chữ cái, số và dấu phẩy',
        'sizes.max' => 'Kích thước không được vượt quá 10 ký tự',
        'image_address_product.required' => 'Ảnh sản phẩm không được để trống',
        'image_address_product.image' => 'File phải là hình ảnh',
        'image_address_product.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif',
        'image_address_product.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
        'describe_product.required' => 'Mô tả không được để trống',
        'describe_product.max' => 'Mô tả không được vượt quá 500 ký tự',
        'describe_product.regex' => 'Mô tả không được chứa ký tự đặc biệt',
        'id_category.required' => 'Danh mục không được để trống',
        'id_category.exists' => 'Danh mục không tồn tại',
        'id_manufacturer.required' => 'Hãng sản xuất không được để trống',
        'id_manufacturer.exists' => 'Hãng sản xuất không tồn tại',
        'specifications.max' => 'Thông số kỹ thuật không được vượt quá 500 ký tự',
        'specifications.regex' => 'Thông số kỹ thuật không được chứa ký tự đặc biệt',
        'colors.regex' => 'Màu sắc chỉ được chứa chữ cái, số và dấu phẩy',
        'colors.max' => 'Màu sắc không được vượt quá 50 ký tự'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'id_manufacturer');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_product', 'id_product');
    }

    // Query Methods
    public static function getProductsWithPagination($perPage = 2)
    {
        return self::orderBy('created_at', 'desc')
                   ->orderBy('id_product', 'desc')
                   ->paginate($perPage);
    }

    public static function searchProducts($keyword, $perPage = 12)
    {
        return self::where('name_product', 'LIKE', '%' . $keyword . '%')
                   ->paginate($perPage);
    }

    public static function filterProducts($filters, $perPage = 12)
    {
        $query = self::query();

        if (!empty($filters['keyword'])) {
            $query->where('name_product', 'like', '%' . $filters['keyword'] . '%');
        }

        if (!empty($filters['category'])) {
            $query->where('id_category', $filters['category']);
        }

        if (!empty($filters['manufacturer'])) {
            $query->where('id_manufacturer', $filters['manufacturer']);
        }

        if (!empty($filters['price_min'])) {
            $query->where('price_product', '>=', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $query->where('price_product', '<=', $filters['price_max']);
        }

        if (!empty($filters['purchased_min'])) {
            $query->where('purchased', '>=', $filters['purchased_min']);
        }

        if (!empty($filters['purchased_max'])) {
            $query->where('purchased', '<=', $filters['purchased_max']);
        }

        // Sort products
        switch ($filters['sort'] ?? 'newest') {
            case 'price_asc':
                $query->orderBy('price_product', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_product', 'desc');
                break;
            case 'purchased':
                $query->orderBy('purchased', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate($perPage);
    }

    public static function getProductsByManufacturer($manufacturerId, $perPage = 12)
    {
        return self::where('id_manufacturer', $manufacturerId)->paginate($perPage);
    }

    public static function findProductById($id)
    {
        return self::where('id_product', $id)->first();
    }

    public static function createProduct($data)
    {
        return self::create([
            'id_category' => $data['selected_category'],
            'id_manufacturer' => $data['selected_manufacturer'], 
            'name_product' => $data['name_product'],
            'quantity_product' => $data['quantity_product'], 
            'price_product' => $data['price_product'],
            'image_address_product' => $data['image_address_product'], 
            'describe_product' => $data['describe_product'],
            'specifications' => $data['specifications'],
            'sizes' => $data['sizes'] ?? null,
            'colors' => $data['colors'] ?? null,
        ]);
    }

    public static function updateProductById($id, $data)
    {
        $product = self::findProductById($id);
        if ($product) {
            $product->id_category = $data['selected_category'];
            $product->id_manufacturer = $data['selected_manufacturer'];
            $product->name_product = $data['name_product'];
            $product->quantity_product = $data['quantity_product'];
            $product->price_product = $data['price_product'];
            $product->describe_product = $data['describe_product'];
            $product->specifications = $data['specifications'];
            $product->sizes = $data['sizes'] ?? $product->sizes;
            $product->colors = $data['colors'] ?? $product->colors;
            
            if (isset($data['image_address_product'])) {
                $product->image_address_product = $data['image_address_product'];
            }
            
            $product->save();
            return $product;
        }
        return null;
    }

    // New methods for HomeController
    public static function getHomePageProducts($perPage = 6)
    {
        return self::orderBy('created_at', 'desc')
                   ->orderBy('id_product', 'desc')
                   ->paginate($perPage);
    }

    public static function getLatestProducts($limit = 6)
    {
        return self::orderBy('created_at', 'desc')
                   ->orderBy('id_product', 'desc')
                   ->take($limit)
                   ->get();
    }

    public static function getProductsWithCategories()
    {
        return self::select('products.*', 'categories.name_category')
                   ->leftJoin('categories', 'products.id_category', '=', 'categories.id_category')
                   ->get();
    }

    public static function getProductsWithManufacturers()
    {
        return self::select('products.*', 'manufacturers.name_manufacturer')
                   ->leftJoin('manufacturers', 'products.id_manufacturer', '=', 'manufacturers.id_manufacturer')
                   ->get();
    }

    public static function getProductDetail($id)
    {
        return self::find($id);
    }

    public function getSpecificationsArray()
    {
        return explode(';', $this->specifications);
    }

    public function getColorsArray()
    {
        return explode(',', $this->colors);
    }

    public function getSizesArray()
    {
        return explode(',', $this->sizes);
    }

    // Add method to check for duplicate products
    public static function isDuplicate($data, $excludeId = null)
    {
        $query = self::where('name_product', $data['name_product']);
        
        if ($excludeId) {
            $query->where('id_product', '!=', $excludeId);
        }
        
        return $query->exists();
    }
}