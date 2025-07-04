<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function indexManufacturer(){
        $manufacturers = Manufacturer::getManufacturersWithPagination(2);
        return view('admin.manufacturer.listManufacturer', ['manufacturers' => $manufacturers]);
    }    

    public function indexAddManufacturer(){
        return view('admin.manufacturer.addmanufacturer');
    }
    
    public function addManufacturer(Request $request){
        try {
            $request->validate([
                'name_manufacturer' => [
                    'required',
                    'string',
                    'max:100',
                    'regex:/^[a-zA-Z0-9À-ỹ\s\.,\-()]+$/u'
                ],
                'image_manufacturer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'name_manufacturer.required' => 'Vui lòng nhập tên hãng sản xuất',
                'name_manufacturer.max' => 'Tên hãng không quá 100 ký tự',
                'name_manufacturer.regex' => 'Tên hãng chỉ được chứa chữ, số và một số ký tự hợp lệ',
                'image_manufacturer.required' => 'Vui lòng chọn ảnh hãng sản xuất',
                'image_manufacturer.image' => 'File phải là ảnh',
                'image_manufacturer.mimes' => 'Chỉ chấp nhận ảnh jpeg, png, jpg, gif',
                'image_manufacturer.max' => 'Ảnh không quá 2MB',
            ]);

            $data = $request->all();

            if($request->hasFile('image_manufacturer')) {
                $file = $request->file('image_manufacturer');
                $ex = $file->getClientOriginalExtension();
                $filename = time().'.'.$ex;
                $file->move('uploads/manufacturerimage/',$filename);
                $data['image_manufacturer'] = $filename;
            }

            Manufacturer::create([
                'name_manufacturer' => $data['name_manufacturer'],
                'image_manufacturer' => $data['image_manufacturer']
            ]);

            return redirect()->route('manufacturer.listmanufacturer')->with('success', 'Thêm hãng sản xuất thành công');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi thêm hãng sản xuất: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function deleteManufacturer(Request $request){
        try {
            $manufacturer_id = $request->get('id');
            $manufacturer = Manufacturer::findOrFail($manufacturer_id);
            
            // Xóa ảnh nếu có
            if ($manufacturer->image_manufacturer) {
                $imagePath = 'uploads/manufacturerimage/' . $manufacturer->image_manufacturer;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $manufacturer->delete();
            return redirect()->route('manufacturer.listmanufacturer')->with('success', 'Xóa hãng sản xuất thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa hãng sản xuất: ' . $e->getMessage());
        }
    }
    
    public function indexUpdateManufacturer(Request $request){
        $manufacturer_id = $request->get('id');
        $manufacturer = Manufacturer::findManufacturerById($manufacturer_id);
        return view('admin.manufacturer.updatemanufacturer', ['manufacturer' => $manufacturer]);
    }

    public function updateManufacturer(Request $request)
    {
        $input = $request->all();
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Kiểm tra manufacturer có tồn tại không
        $manufacturer = Manufacturer::find($input['id']);
        
        if (!$manufacturer) {
            // Log lỗi chi tiết
            \Log::warning('Attempt to update non-existent manufacturer', [
                'manufacturer_id' => $input['id'],
                'attempted_by' => session('id_user'),
                'timestamp' => now(),
                'ip_address' => request()->ip()
            ]);
            
            // Lưu thông báo lỗi vào session để hiển thị sau reload
            return redirect('listmanufacturer')->withErrors([
                'error' => 'Hãng sản xuất ID#' . $input['id'] . ' không tồn tại hoặc đã bị xóa bởi người khác! Danh sách đã được cập nhật.'
            ])->with('reload_needed', true);
        }

        // Kiểm tra manufacturer có products không (nếu có thể ảnh hưởng)
        if ($manufacturer->products && $manufacturer->products->count() > 0) {
            \Log::info('Updating manufacturer with existing products', [
                'manufacturer_id' => $input['id'],
                'products_count' => $manufacturer->products->count(),
                'manufacturer_name' => $manufacturer->name
            ]);
        }

        // Cập nhật thông tin
        $manufacturer->name = $input['name'];
        $manufacturer->description = $input['description'];
        
        // Xử lý upload image nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu cần
            if ($manufacturer->image && file_exists(public_path('images/manufacturers/' . $manufacturer->image))) {
                unlink(public_path('images/manufacturers/' . $manufacturer->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/manufacturers'), $imageName);
            $manufacturer->image = $imageName;
        }
        
        $manufacturer->save();
        
        // Log thành công
        \Log::info('Manufacturer updated successfully', [
            'manufacturer_id' => $manufacturer->id,
            'manufacturer_name' => $manufacturer->name,
            'updated_by' => session('id_user')
        ]);
        
        return redirect('listmanufacturer')->with('success', 'Cập nhật hãng sản xuất thành công!');
    }
}