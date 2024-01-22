<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShinseiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if ($this->has('matter_change_date')) {
            $rules['matter_change_date'] = 'required|string|max:50';
        }

        if ($this->has('hour1')) {
            $rules['hour1'] = 'integer';
        }
        if ($this->has('hour2')) {
            $rules['hour2'] = 'integer';
        }
        if ($this->has('minutes1')) {
            $rules['minutes1'] = 'integer';
        }
        if ($this->has('minutes2')) {
            $rules['minutes2'] = 'integer';
        }
        if ($this->has('breaktime')) {
            $rules['breaktime'] = 'integer';
        }

        if ($this->has('work_content')) {
            $rules['work_content'] = 'required|string|max:250';
        }
        if ($this->matter_type==1) {
            if ($this->has('order_content')) {
                $rules['order_content'] = 'required|string|max:250';
            }

            $rules['opt1'] = 'required';
        }elseif ($this->matter_type==2) {

            $rules['opt1'] = 'required';
            if (in_array($this->opt1, [9, 10, 11])) {
                if ($this->has('order_content')) {
                    $rules['order_content'] = 'required|string|max:250';
                }
            }
        }elseif($this->matter_type==3) {
            if ($this->has('order_content')) {
                $rules['order_content'] = 'required|string|max:250';
            }
        }elseif($this->matter_type==7) {
            if ($this->has('matter_name')) {
                $rules['matter_name'] = 'required|string|max:250';
            }
        }

        return $rules;
    }
    public function messages()
    {
        $messages = [
                'matter_change_date.required' => '予定日は必須です。',
                'order_content.required'   => '理由は必須です。',
                'work_content.required'   => '作業内容は必須です。',
                'opt1.required'  => '申請種別を選択してください。',
                'breaktime.integer'  => '休憩時間は0以上の数値を入力してください。',
                'hour1.integer'  => '開始時間は0以上の数値を入力してください。',
                'minutes1.integer'  => '開始時間は0以上の数値を入力してください。',
                'hour2.integer'  => '終了時間は0以上の数値を入力してください。',
                'minutes2.integer'  => '終了時間は0以上の数値を入力してください。',
                'matter_name.required'  => '品名は必須です。',
        ];

        if ($this->matter_type == 7) {
            $messages['order_content.required'] = "目的は必須です。";
            $messages['work_content.required'] = "目的は必須です。";
        }

        return $messages;
    }
}
