<style>

</style>

<template>
    <div>
        <div class="form-group">
            <input type="text" ref="subject" v-model="subject" name="subject" class="form-control input-md" autofocus required/>
        </div>
        <div class="form-group">
            <codemirror v-model="cmModel" :options="cmOptions"></codemirror>
        </div>
        <div class="form-group text-center" style="position:relative;">
            <button type="button" @click="submitCode" class="btn btn-success"><i class="fa fa-check"></i> 提交代码</button>
            <a class="btn btn-outline-secondary" href="/">取消</a>

            <a id="navbarDropdown" class="dropdown-toggle btn btn-outline-secondary" href="#" role="button"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" style="position: absolute;right:0px;">
                {{ code_language.name.toUpperCase() }} <span class="caret"></span></a>
            <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" v-for="lang in code_language_list"
                   @click="changeCodeLanguage(lang.name)">{{
                    lang.name.toUpperCase() }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    // require component
    import {codemirror} from 'vue-codemirror'

    // require styles
    import 'codemirror/lib/codemirror.css'
    import 'codemirror/theme/solarized.css'
    import 'codemirror/theme/cobalt.css'
    import 'codemirror/mode/javascript/javascript.js'
    import 'codemirror/mode/php/php.js'

    const Swal = require('sweetalert2')

    export default {
        name: 'code_editor',
        components: {
            codemirror
        },
        props: ['name'],
        data() {
            return {
                subject: '',
                code_language: {},
                code_language_list: [
                    {'name': 'php', 'mime': 'application/x-httpd-php', 'theme': 'cobalt'},
                    {'name': 'js', 'mime': 'text/javascript', 'theme': 'solarized light'},
                ],
                cmModel: null,
                cmOptions: {
                    tabSize: 4,
                    lineNumbers: true,
                    line: true,
                    showCursorWhenSelecting: true,
                    theme: '',
                    mime: ''
                }
            }
        },
        methods: {
            changeCodeLanguage(lang) {
                this.code_language_list.filter((v, i) => {
                    if (lang === v.name) {
                        this.code_language = v;
                        return;
                    }
                });
            },
            submitCode() {
                let data = {
                    'subject': this.subject,
                    'code': this.cmModel,
                    'language': this.code_language,
                }
                this.$axios.post('code/save', data).then((res) => {

                    Swal.fire(
                        '发布成功',
                        '您的代码已成功发布到共享平台',
                        'success'
                    ).then(() => {
                        window.location.href = '/';
                    })

                }).catch(error => {
                    for (let obj of Object.keys(error.response.data.errors)) {
                        Swal.fire(
                            '提交失败',
                            error.response.data.errors[obj][0],
                            'error'
                        )
                    }
                    this.isCommentting = false
                })
            },
        },
        mounted() {
            this.$refs['subject'].focus();
        },
        created() {
            this.changeCodeLanguage('php');
        },
        watch: {
            code_language(val, oldVal) {
                this.cmOptions.mode = val.mime;
                this.cmOptions.theme = val.theme;
            }
        }
    }
</script>