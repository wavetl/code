<style>

</style>

<template>
    <div>
        <div class="form-group">
            <input type="text" ref="subject" v-model="subject" name="subject" class="form-control input-md"
                   required/>
        </div>
        <div class="form-group">
            <div class="spinner-container" v-if="loading">
                <spinner :loading="true" :color="'#3490dc'"></spinner>
            </div>
            <codemirror v-else v-model="cmModel" :options="cmOptions"></codemirror>
        </div>
        <div class="form-group text-center" style="position:relative;">
            <button type="button" @click="submitCode" class="btn btn-success"><i class="fa fa-check"></i> <span
                    v-text="code_id ? '修改代码' : '提交代码'"></span></button>
            <a class="btn btn-outline-secondary" href="/">取消</a>

            <a id="navbarDropdown" :class="'dropdown-toggle btn btn-sm ' + code_language.cssClass" href="#"
               role="button"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" style="position: absolute;right:0px;">
                <i :class="'fab fa-' + code_language.id"></i> {{ code_language.name }} <span class="caret"></span></a>
            <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" v-for="lang in code_language_list"
                   @click="changeCodeLanguage(lang.id)"><i :class="'fab fa-' + lang.id"></i> {{
                    lang.name }}</a>
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
    import 'codemirror/theme/material.css'
    import 'codemirror/mode/javascript/javascript.js'
    import 'codemirror/mode/php/php.js'
    import 'codemirror/mode/python/python.js'

    const Swal = require('sweetalert2')

    import GridLoader from 'vue-spinner/src/GridLoader'

    export default {
        name: 'code_editor',
        components: {
            codemirror,
            'spinner': GridLoader
        },
        props: ['name', 'code_id'],
        data() {
            return {
                loading: false,
                subject: '',
                code_language: {},
                code_language_list: [
                    {
                        'id': 'php',
                        'name': 'PHP',
                        'mime': 'application/x-httpd-php',
                        'theme': 'cobalt',
                        'cssClass': 'btn-outline-primary'
                    },
                    {
                        'id': 'js',
                        'name': 'JavaScript',
                        'mime': 'text/javascript',
                        'theme': 'solarized light',
                        'cssClass': 'btn-outline-success'
                    },
                    {
                        'id': 'python',
                        'name': 'Python',
                        'mime': 'text/x-python',
                        'theme': 'material',
                        'cssClass': 'btn-outline-danger'
                    },
                    {
                        'id': 'css',
                        'name': 'CSS',
                        'mime': 'text/css',
                        'theme': 'material',
                        'cssClass': 'btn-outline-info'
                    }
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
                    if (lang === v.id) {
                        this.code_language = v;
                        return;
                    }
                });
            },
            fetchCode() {
                this.loading = true
                let data = {'code_id': this.code_id}
                this.$axios.post('code/find', data).then((res) => {
                    this.subject = res.data.subject;
                    this.cmModel = res.data.code;
                    this.changeCodeLanguage(res.data.language);

                    this.$nextTick(() => {
                        this.loading = false
                    })
                })
            },
            submitCode() {
                let data = {
                    'id': this.code_id,
                    'subject': this.subject,
                    'code': this.cmModel,
                    'language': this.code_language.id,
                }
                this.$axios.post('code/save', data).then((res) => {

                    Swal.fire(
                        this.code_id ? '修改成功' : '分享成功',
                        this.code_id ? '代码修改成功' : '你的代码已经成功分享',
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
            if (!this.code_id) {
                this.$refs['subject'].focus();
            }
        },
        created() {
            if (this.code_id) {
                this.fetchCode();
            } else {
                this.changeCodeLanguage('php');
            }
        },
        watch: {
            code_language(val, oldVal) {
                this.cmOptions.mode = val.mime;
                this.cmOptions.theme = val.theme;
            }
        }
    }
</script>