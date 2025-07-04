<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index() {
        $banners = Banner::orderBy('id_banner', 'desc')->paginate(10);
        return view('admin.banner.index', compact('banners'));
    }

    public function create() {
        return view('admin.banner.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);
        $data = $request->only(['title', 'content', 'status']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banner'), $imageName);
            $data['image'] = $imageName;
        }
        Banner::create($data);
        return redirect()->route('banner.index')->with('success', 'Thêm banner thành công!');
    }

    public function edit($id) {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id) {
        $banner = Banner::findOrFail($id);
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);
        $data = $request->only(['title', 'content', 'status']);
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($banner->image && file_exists(public_path('uploads/banner/' . $banner->image))) {
                unlink(public_path('uploads/banner/' . $banner->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banner'), $imageName);
            $data['image'] = $imageName;
        }
        $banner->update($data);
        return redirect()->route('banner.index')->with('success', 'Cập nhật banner thành công!');
    }

    public function destroy($id) {
        $banner = Banner::findOrFail($id);
        if ($banner->image && file_exists(public_path('uploads/banner/' . $banner->image))) {
            unlink(public_path('uploads/banner/' . $banner->image));
        }
        $banner->delete();
        return redirect()->route('banner.index')->with('success', 'Xóa banner thành công!');
    }
} 