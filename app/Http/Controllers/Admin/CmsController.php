<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\AdminsRole;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Session;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put("page", 'cms-pages');
        $CmsPages = CmsPage::get();
        // dd($CmsPages);

        //set admin/subadmin permission untuk cms page
        $cmspagesModulCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'cms_pages'])->count();
        $pagesModul = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $pagesModul['view_access'] = 1;
            $pagesModul['edit_access'] = 1;
            $pagesModul['full_access'] = 1;
        } else if ($cmspagesModulCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $pagesModul = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'cms_pages'])->first()->toArray();
        }

        return view("admin.pages.cms_pages")->with(compact('CmsPages', 'pagesModul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Tambah halaman CMS";
            $cmspage = new CmsPage;
            $message = "Berhasil menambah halaman CMS";
        } else {
            $title = "Edit halaman CMS";
            $cmspage = CmsPage::find($id);
            $message = "Berhasil mengedit halaman CMS";
        }

        if ($request->isMethod("post")) {
            $data = $request->all();
            //CMS pages Validation
            $rules = [
                "title" => "required",
                "url" => "required",
                "description" => "required",
            ];
            $customMessages = [
                'title.required' => 'Wajib mengisi Judul',
                'url.required' => 'Wajib mengisi URL',
                'description.required' => 'Wajib mengisi Deskripsi',
            ];
            $this->validate($request, $rules, $customMessages);

            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->status = 1;
            $cmspage->save();
            return redirect('admin/cms-pages')->with('success_message', $message);
        }
        return view("admin.pages.add_edit_cmspage")->with(compact("title", "cmspage"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            CmsPage::where("id", $data['page_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //Delete CMSPage
        CmsPage::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Halaman CMS berhasil dihapus');
    }
}
