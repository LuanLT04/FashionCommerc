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
        try {
            $request->validate([
                'name_manufacturer' => [
                    'required',
                    'string',
                    'max:100',
                    'regex:/^[a-zA-Z0-9À-ỹ\s\.,\-()]+$/u'
                ],
                'image_manufacturer' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'name_manufacturer.required' => 'Vui lòng nhập tên hãng sản xuất',
                'name_manufacturer.max' => 'Tên hãng không quá 100 ký tự',
                'name_manufacturer.regex' => 'Tên hãng chỉ được chứa chữ, số và một số ký tự hợp lệ',
                'image_manufacturer.image' => 'File phải là ảnh',
                'image_manufacturer.mimes' => 'Chỉ chấp nhận ảnh jpeg, png, jpg, gif',
                'image_manufacturer.max' => 'Ảnh không quá 2MB',
            ]);

            $input = $request->all();
            
            // Kiểm tra manufacturer có tồn tại không
            $manufacturer = Manufacturer::find($input['id']);
            
            if (!$manufacturer) {
                return redirect()->route('manufacturer.listmanufacturer')
                    ->with('error', 'Hãng sản xuất không tồn tại hoặc đã bị xóa!');
            }

            // Cập nhật thông tin
            $manufacturer->name_manufacturer = $input['name_manufacturer'];
            
            // Xử lý upload image nếu có
            if ($request->hasFile('image_manufacturer')) {
                // Xóa ảnh cũ nếu cần
                if ($manufacturer->image_manufacturer && File::exists('uploads/manufacturerimage/' . $manufacturer->image_manufacturer)) {
                    File::delete('uploads/manufacturerimage/' . $manufacturer->image_manufacturer);
                }
                
                $file = $request->file('image_manufacturer');
                $ex = $file->getClientOriginalExtension();
                $filename = time().'.'.$ex;
                $file->move('uploads/manufacturerimage/', $filename);
                $manufacturer->image_manufacturer = $filename;
            }
            
            $manufacturer->save();
            
            return redirect()->route('manufacturer.listmanufacturer')
                ->with('success', 'Cập nhật hãng sản xuất thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi cập nhật hãng sản xuất: ' . $e->getMessage())
                ->withInput();
        }
    }
}