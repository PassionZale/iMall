<template>
    <form id="suggest-form" @submit.prevent="submitSuggestion()">
        <div class="form-wrapper">
            <title>问题或建议</title>
            <mt-field
                    placeholder="请描述您的问题或建议，我们将尽快优化体验，感谢您的反馈。"
                    slot="suggestion"
                    type="textarea"
                    rows="6"
                    :value.sync="suggestion">
            </mt-field>
        </div>
        <div class="form-wrapper">
            <mt-button :disabled="form_disabled" type="primary" size="large">提交</mt-button>
        </div>
    </form>
</template>

<script>
    import { Field } from 'mint-ui';
    import { Button } from 'mint-ui';
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return{
                suggestion:'',
                form_disabled:true
            }
        },
        components:{
            Field, Button, Indicator, Toast
        },
        watch:{
            'suggestion':{
                handler:function(val){
                    val !== '' ? this.$set('form_disabled', false)
                    : this.$set('form_disabled', true);
                }
            }
        },
        methods:{
            submitSuggestion:function(){
                Indicator.open();
                let vm = this;
                vm.$http.post('/api/suggestion',{suggestion:vm.suggestion}).then(function(response){
                    if(response.data.code === 0){
                        Toast({
                          message: '操作成功'
                        });
                        vm.$router.go('/usercenter');
                    }else{
                        Toast({
                          message: '操作失败'
                        });
                    }
                    Indicator.close();
                });
            }
        }
    }
</script>
