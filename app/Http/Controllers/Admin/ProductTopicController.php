<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductTopic;
use Image;

class ProductTopicController extends Controller
{
    public function index()
    {
        $topics = ProductTopic::paginate(10);
        return view('admin.product.topic.index')->with(['topics' => $topics]);
    }

    public function create()
    {
        return view('admin.product.topic.create');
    }

    public function store(Request $request)
    {
        $topic = new ProductTopic();
        if (!empty($request->input('topic_sort'))) {
            $topic->topic_sort = $request->input('topic_sort');
        }
        $topic->topic_title = $request->input('topic_title');
        $topic->disabled = $request->input('disabled');
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/topic/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(100, 100)
                ->save('.' . $filePath . $fileName);
            $topic->topic_img = $filePath . $fileName;
        } else {
            return redirect()->to('admin/product/topic')->withError('图片不合法！');
        }
        if ($topic->save()) {
            return redirect()->to('admin/product/topic')->withSuccess('新增专题成功！');
        } else {
            return redirect()->to('admin/product/topic')->withError('新增专题失败！');
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $topic = ProductTopic::findOrFail($id);
        return view('admin.product.topic.edit')->with(['topic' => $topic]);
    }

    public function update(Request $request, $id)
    {
        $topic = ProductTopic::findOrFail($id);
        if (!empty($request->input('topic_sort'))) {
            $topic->topic_sort = $request->input('topic_sort');
        }
        $topic->topic_title = $request->input('topic_title');
        $topic->disabled = $request->input('disabled');
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/topic/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(100, 100)
                ->save('.' . $filePath . $fileName);
            $topic->topic_img = $filePath . $fileName;
        }
        if ($topic->save()) {
            return redirect()->to('admin/product/topic')->withSuccess('新增修改成功！');
        } else {
            return redirect()->to('admin/product/topic')->withError('新增修改失败！');
        }
    }

    public function destroy($id)
    {
        $topic = ProductTopic::findOrFail($id);
        $topic->delete();
        return redirect()->to('admin/product/topic')->withSuccess('专题删除成功！');
    }
}
