<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WechatSuggestion;
use App\WechatAddress;
use App\WechatFollow;
use Validator;

class UserController extends Controller
{
    public function userinfo()
    {
        $user = session('wechat.oauth_user')->toArray();
        return response()->json($user);
    }

    public function suggestion(Request $request)
    {
        $follow = session()->get('wechat.oauth_user');
        $suggestion = $request->input('suggestion');
        $suggest = new WechatSuggestion();
        $suggest->openid = $follow->id;
        $suggest->content = $suggestion;
        if ($suggest->save()) {
            return response()->json(['code' => 0]);
        } else {
            return response()->json(['code' => -1]);
        }
    }

    public function indexAddress()
    {
        $wechat = session()->get('wechat.oauth_user');
        $openid = $wechat->id;
        $follow = WechatFollow::where('openid', '=', $openid)->first();
        if ($follow) {
            $addresses = $follow->addresses()->get();
            return response()->json([
                'code' => 0,
                'message' => $addresses
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '没有相关地址'
            ]);
        }
    }

    public function storeAddress(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'phone' => array('regex:/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/'),
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'defaulted' => 'required|boolean',
        ];
        $messages = [
            'name.required' => '收货人还未填写',
            'phone.required' => '手机号码还未填写',
            'phone.regex' => '手机号码不合法',
            'province.required' => '未选择省',
            'city.required' => '未选择市',
            'address.required' => '详细地址还未填写',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => -1,
                    'message' => $validator->errors()->first(),
                ]
            );
        } else {
            $address = new WechatAddress();
            $follow = session()->get('wechat.oauth_user');
            $address->openid = $follow->id;
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->province = $request->province;
            $address->city = $request->city;
            $address->district = $request->district;
            $address->address = $request->address;
            $address->defaulted = $request->defaulted;
            if ($address->save()) {
                if ($address->defaulted) {
                    // 将其他地址defaulted设置为FALSE
                    WechatAddress::where('id', '!=', $address->id)
                        ->where('openid', '=', $address->openid)
                        ->update(['defaulted' => FALSE]);
                }
                return response()->json(
                    [
                        'code' => 0,
                        'message' => '操作成功'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'code' => -1,
                        'message' => '请求超时'
                    ]
                );
            }
        }
    }

    public function showAddress($id)
    {
        $address = WechatAddress::find($id);
        if ($address) {
            return response()->json([
                'code' => 0,
                'message' => $address
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '没有相关地址'
            ]);
        }
    }

    public function updateAddress(Request $request, $id)
    {
        $wechat = session()->get('wechat.oauth_user');
        $openid = $wechat->id;
        $address = WechatAddress::find($id);
        if ($address && $openid === $address->openid) {
            $rules = [
                'name' => 'required',
                'phone' => 'required',
                'phone' => array('regex:/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/'),
                'province' => 'required',
                'city' => 'required',
                'address' => 'required',
                'defaulted' => 'required|boolean',
            ];
            $messages = [
                'name.required' => '收货人还未填写',
                'phone.required' => '手机号码还未填写',
                'phone.regex' => '手机号码不合法',
                'province.required' => '未选择省',
                'city.required' => '未选择市',
                'address.required' => '详细地址还未填写',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'code' => -1,
                        'message' => $validator->errors()->first(),
                    ]
                );
            } else {
                $address->name = $request->name;
                $address->phone = $request->phone;
                $address->province = $request->province;
                $address->city = $request->city;
                $address->district = $request->district;
                $address->address = $request->address;
                $address->defaulted = $request->defaulted;
                if ($address->save()) {
                    if ($address->defaulted) {
                        // 将其他地址defaulted设置为FALSE
                        WechatAddress::where('openid', '=', $openid)
                            ->where('id', '!=', $id)
                            ->update(['defaulted' => FALSE]);
                    }
                    return response()->json(
                        [
                            'code' => 0,
                            'message' => '操作成功'
                        ]
                    );
                } else {
                    return response()->json(
                        [
                            'code' => -1,
                            'message' => '请求超时'
                        ]
                    );
                }
            }
        } else {
            return response()->json([
                'code' => -1,
                'message' => '没有相关地址'
            ]);
        }
    }

    public function deleteAddress($id)
    {
        $address = WechatAddress::find($id);
        if ($address) {
            if ($address->delete()) {
                return response()->json([
                    'code' => 0,
                    'message' => '操作成功'
                ]);
            } else {
                return response()->json([
                    'code' => -1,
                    'message' => '请求超时'
                ]);
            }
        } else {
            return response()->json([
                'code' => -1,
                'message' => '该地址不存在'
            ]);
        }
    }

    public function defaultAddress(){
        $follow = session()->get('wechat.oauth_user');
        $openid = $follow->id;
        // 查询该粉丝是否建立过收货地址
        $addresses = WechatAddress::where('openid','=',$openid)->get();
        if(count($addresses)){
            $default_address = [];
            foreach($addresses as $address){
                if($address['defaulted'] == 1){
                    $default_address = $address;
                    break;
                }
            }
            if($default_address){
                // 存在默认地址，则返回默认地址
                return response()->json([
                    'code' => 0,
                    'message' => $default_address
                ]);
            }else{
                // 不存在默认地址，则返回第一条地址数据
                return response()->json([
                    'code' => 0,
                    'message' => $addresses->first()
                ]);
            }
        }else{
            return response()->json([
                'code' => 0,
                'message' => ''
            ]);
        }
    }

}
