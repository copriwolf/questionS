(function () {
    'use strict';

    "use strict";

    function bodyResize() {
        if (window.innerWidth > 640) {
            $('.wrapper').height(window.innerHeight);
            var b_width = window.innerHeight * 640 / 1038;
            $('body').width(b_width);
        }
        else {
            var s_height = 1038 / 640 * window.innerWidth;
            if (window.innerHeight > s_height) {
                $('.wrapper').height(window.innerHeight);
            }
            else {
                $('.wrapper').height(s_height);
            }
        }
        if (window.innerWidth > 640) {
            $('.wrapper1').height(window.innerHeight);
            var b_width = window.innerHeight * 640 / 1038;
            $('body').width(b_width);
        }
        else {
            var s_height = 1038 / 640 * window.innerWidth;
            if (window.innerHeight > s_height) {
                $('.wrapper1').height(window.innerHeight);
            }
            else {
                $('.wrapper1').height(s_height);
            }
        }
    }

    bodyResize();

    /*控制横竖屏*/
    function hengshuping() {
        if (window.orientation === 180 || window.orientation === 0) {
            $(".hortips").css({
                display: 'none'
            });
        }
        if (window.orientation === 90 || window.orientation === -90) {
            $(".hortips").css({
                display: 'block'
            });
        }
    }

    hengshuping();
    window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", hengshuping, false);
    $(function () {
        //弹窗遮罩层
        var $pop = $('#pop');
        var $msg_1 = $('.msg-1');
        $('.layer').click(function () {
            $pop.hide(200);
            $msg_1.hide(200);
            return false;
        });
        // 点击跳转事件
        var $end = $('#end');
        var $back = $('#back');
        var $sale = $('#sale');
        var $afterSales = $('#afterSales');

        function page_hide() {
            $('.wrap').hide();
        }

        // 获取不同问卷
        function getSurvey(type) {
            switch (type) {
                case "1":
                    $('.q-txt').html("(销售)");
                    break;
                case "2":
                    $('.q-txt').html("(售后)");
                    break;
            }
            $.ajax({
                url: '?r=nps-survey/get-survey-data&type=' + type,
                type: 'get',
                success: function (data) {
                    handleData(data, '#content_1', type);
                }
            });
        }
        //问卷结束
        $end.on('click', function () {
            show_page('.wrap5');
        });
        $sale.on('click', function () {
            page_hide();
            $('.wrap4').show();
        });
        $afterSales.on('click', function () {
            page_hide();
            $('.wrap4').show();
        });
        //重选问卷
        $back.on('click', function () {
            console.log('s');
            show_page('.wrap3');
        });

        // 处理 输入，单选，多选 绑定
        var input_selector = [];
        var single_selector = [];
        var handleData = function (response, dom, type) {
            // 解析 json
            var res = JSON.parse(response);
            // 判断请求成功
            if (res.code !== 200) {
                // 根据不同的code, 弹出提示框，方便后期查找问题
                alert("\u8BF7\u6C42\u9519\u8BEF\uFF1A" + res.code + " " + res.msg);
                return;
            }
            // 获取到数据
            var data = res.data;
            //data.splice(0,1);
            // 拼接页面内容
            var html = "";
            // 循环生成问题
            for (var i = 1; i < data.length; i++) {
                html += create_question(data, i);
            }
            // 提交问卷
            html += "\n            <a class=\"submitBtn btn-loca1 word2\" data-type=" + type + ">\u63D0\u4EA4\u95EE\u5377</a>\n        ";
            //注入页面
            $(dom).html(html);
            eventBind();
            handle_bind();
        };

        // 分数提示
        function score_tip(questionNum, question) {
            switch (questionNum) {
                case 'A4-2a':
                    question += "\n                        <p class=\"q-question word9-blue\">\uFF08\u5982A3\u9898\u8BC4\u5206\u57289-10\u5206\uFF0C\u5219\u8BE2\u95EEA4-2a\uFF09</p>\n                    ";
                    break;
                case 'A4-2b':
                    question += "\n                        <p class=\"q-question word9-blue\">\uFF08\u5982A3\u9898\u8BC4\u5206\u57281-8\u5206\uFF0C\u5219\u8BE2\u95EEA4-2b\uFF09</p>\n                ";
                    break;
            }
            return question;
        }

        // 题目
        function q_title(questionNum, questionContent, question) {
            question += "\n            <div class=\"qBox\" id=\"" + questionNum + "\">\n                    <p class=\"q-question word9\">" + questionNum + questionContent + "</p>\n        ";
            return question;
        }

        // 标注
        function mark(questionNum, html) {
            var arr = ['A4-2a', 'A4-2b'];
            if (arr.indexOf(questionNum) !== -1) {
                html += "\n                <p class=\"q-question word9-blue\">\u6807\u6CE8\uFF1A\uFF08\u6839\u636E\u88AB\u8BBF\u8005\u7684\u56DE\u7B54\u5708\u9009\u4E0B\u8868\u4E2D\u76F8\u5E94\u9009\u9879\uFF0C\u5E76\u5728\u5BF9\u5E94\u4F4D\u7F6E\u8BB0\u5F55\u88AB\u8BBF\u8005\u539F\u8BDD\uFF09</p>\n            ";
            }
            return html;
        }

        // 针对不同问题类型的处理
        var handleTypes = {
            '1': handle_type_1,
            '2': handle_type_2,
            '3': handle_type_3,
            '4': handle_type_4,
            '5': handle_type_5,
            '6': handle_type_6,
            '7': handle_type_7
        };

        function handle_type_1(question, data, index, answer) {
            var questionNum = data[index].questionNum.replace('-', '').toUpperCase();
            question += "<ul>";
            for (var j = 0; j < answer.length; j++) {
                if (!answer[j])
                    break;
                question += "<li class=" + (questionNum + '-single') + " data-qid=\"" + answer[j].ID + "\" data-qnum=\"" + questionNum + "\">" + answer[j].content + "</li>";
            }

            question += "</ul>";
            single_selector.push("." + questionNum + "-single");
            return question;
        }

        function handle_type_2(question, data, index, answer) {
            var questionNum = data[index].questionNum.replace('-', '').toUpperCase();
            question += "<input type=\"text\" class=\"record record-long\" id=" + (questionNum + '-input') + " data-qNum = " + questionNum + ">";
            input_selector.push("#" + questionNum + "-input");
            return question;
        }

        function handle_type_3(question, data, index, answer) {
            var questionNum = data[index].questionNum.replace('-', '').toUpperCase();
            question += "<ul class=\"q-1-ul\">";
            for (var j = 0; j < answer.length; j++) {
                if (!answer[j])
                    break;
                question += "\n                <li class=" + (questionNum + '-single') + " data-qid=\"" + answer[j].ID + "\" data-qnum=\"" + questionNum + "\">" + answer[j].content + "\n            ";
                if (answer[j].hasText === '1') {
                    question += "<input class=\"record\" id=" + (questionNum + '-input') + " data-qNum = " + (questionNum + 'Other') + ">";
                    input_selector.push("#" + questionNum + "-input");
                }
                question += "</li>";
            }

            question += "</ul>";
            single_selector.push("." + questionNum + "-single");
            return question;
        }

        function handle_type_4(question, data, index, answer) {
            var txt = {
                'A2': {
                    head: '经销店销售服务满意度',
                    body: ['非常满意', '非常不满意']
                },
                'A3': {
                    head: '经销店销售服务推荐度',
                    body: ['肯定会推荐', '肯定不会推荐']
                },
                'C1': {
                    head: '品牌推荐度',
                    body: ['肯定会推荐', '肯定不会推荐']
                },
                'B4': {
                    head: '经销店售后服务推荐度',
                    body: ['肯定会推荐', '肯定不会推荐']
                },
                'C2': {
                    head: '品牌推荐度',
                    body: ['肯定会推荐', '肯定不会推荐']
                }
            };
            var questionNum = data[index].questionNum;
            question += "\n            <table class=\"agree-select-table\">\n                <tr>\n                    <th>" + questionNum + "</th>\n                    <th class=\"th-bg-color\">" + txt[questionNum].body[0] + "</th>\n                    <th>" + txt[questionNum].body[1] + "</th>\n                </tr>\n                <tr>\n                    <td>" + txt[questionNum].head + "</td>\n                    <td colspan=\"2\">\n                        <ul class=\"table-ul\">\n        ";
            var qNum = data[index].questionNum.replace('-', '').toUpperCase();
            for (var j = 0; j < answer.length; j++) {
                if (!answer[j])
                    break;
                question += "\n                <li class=" + (qNum + '-single') + " data-qid=\"" + answer[j].ID + "\" data-qnum=\"" + qNum + "\">\n                    " + answer[j].content + "\n                </li>\n            ";
            }

            single_selector.push("." + qNum + "-single");
            question += "\n                        </ul>\n                    </td>\n                </tr>\n            </table>\n        ";
            return question;
        }

        function handle_type_5(question, data, index, answer) {
            var txt_src = [
                [
                    '1.人员的表现（包括销售顾问的态度和专业能力）',
                    '2.试乘试驾',
                    '3.车辆购买及交付',
                    '4.经销店地理位置、交通及硬件设施',
                    '5. 咨询/投诉处理及其他',
                ],
                [
                    '1.人员的表现（包括服务顾问的态度和专业能力）',
                    '2.维修保养质量和时间',
                    '3.经销店的设施及地理位置',
                    '4.收费合理性和透明度',
                    '5.回访、客户关怀及其他',
                ]
            ];
            var txt = {
                'A4-2a': txt_src[0],
                'A4-2b': txt_src[0],
                'B3-1': txt_src[1],
                'B5-2a': txt_src[1],
                'B5-2b': txt_src[1]
            };
            var questionNum = data[index].questionNum;
            var qNum = data[index].questionNum.replace('-', '').toUpperCase();
            question += "\n            <table class=\"record-select-table\">\n        ";
            for (var j = 0; j < txt[questionNum].length; j++) {
                question += "\n              <tr>\n                   <td>" + txt[questionNum][j] + "</td>\n                   <td>\n                     <textarea class=\"record-textarea\" placeholder=\"\u586B\u5199\" id=" + (qNum + (j + 1) + '-input') + " data-qNum = " + (qNum + (j + 1)) + "></textarea>\n                   </td>\n              </tr>     \n            ";
                input_selector.push("#" + (qNum + (j + 1)) + "-input");
            }

            question += "\n            </table>\n        ";
            return question;
        }

        function handle_type_6(question, data, index, answer) {
            var questionNum = data[index].questionNum.replace('-', '').toUpperCase();
            question += "\n            <table class=\"brand-select-table\">\n        ";
            for (var j = 0; j < answer.length - 1; j++) {
                question += "\n              <tr>\n                   <td class=" + (questionNum + '-single') + " data-qid=\"" + answer[j].ID + "\" data-qnum=" + questionNum + ">" + answer[j].content + "</td>\n              </tr>     \n            ";
            }

            // 其他项目
            question += "\n          <tr>\n               <td>" + answer[answer.length - 1].content + "\n                    <input class=\"record\" id=" + (questionNum + '-input') + " data-qNum = " + (questionNum + 'Other') + ">\n               </td>\n          </tr>     \n        ";
            question += "\n            </table>\n        ";
            single_selector.push("." + questionNum + "-single");
            input_selector.push("#" + questionNum + "-input");
            return question;
        }

        function handle_type_7(question, data, index, answer) {
            var questionNum = data[index].questionNum;
            question += "\n            <table class=\"brand-select-table\">\n        ";
            for (var j = 0; j < answer.length; j++) {
                var content = answer[j].content;
                var content_1 = void 0, content_2 = void 0;
                if (content.indexOf('___') !== -1) {
                    var arr = content.split('___');
                    content_1 = arr[0];
                    content_2 = arr[1];
                    question += "\n                    <tr>\n                       <td class=" + (questionNum + '-single') + " data-qid=\"" + answer[j].ID + "\" data-qnum=" + questionNum + ">\n                            " + content_1 + "\n                            <input class=\"record record-short\">\n                            " + content_2 + "\n                       </td>\n                    </tr>     \n                ";
                }
                else {
                    question += "\n                    <tr>\n                       <td class=" + (questionNum + '-single') + " data-qid=\"" + answer[j].ID + "\" data-qnum=" + questionNum + ">\n                           " + content + "\n                       </td>\n                    </tr>     \n                ";
                }
            }

            question += "\n            </table>\n        ";
            single_selector.push("." + questionNum + "-single");
            return question;
        }

        // 标签闭合
        function q_close(question) {
            question += "\n            </div>\n        ";
            return question;
        }

        // 生成问题
        function create_question(data, i) {
            var question = "";
            var questionNum = data[i].questionNum;
            var questionContent = data[i].questionContent;
            var questionType = data[i].questionType;
            var questionCurrentAnswer = data[i].answer;
            // 分数提示
            question = score_tip(questionNum, question);
            // 题目
            question = q_title(questionNum, questionContent, question);
            // 标注
            question = mark(questionNum, question);
            // 针对不同问题类型做处理
            question = handleTypes[questionType](question, data, i, questionCurrentAnswer);
            question = q_close(question);
            return question;
        }

        //页面切换
        function show_page(dom) {
            $('.wrap').hide();
            $(dom).show();
        }


        var surveyAnswers = {
            Name: '',
            S1: '',
            S1Other: '',
            S2: '',
            S2Other: '',
            S3: '',
            S4: '',
            S5: '',
            S6: '',
            A1: '',
            A2: '',
            A3: '',
            A31: '',
            A42A1: '',
            A42A2: '',
            A42A3: '',
            A42A4: '',
            A42A5: '',
            A42B1: '',
            A42B2: '',
            A42B3: '',
            A42B4: '',
            A42B5: '',
            C1: '',
            C2: '',
            C3: '',
            C3Other: '',
            // Name: '',
            // S1: '',
            // S1Other: '',
            // S2: '',
            // S2Other: '',
            // S3: '',
            // S4: '',
            // S5: '',
            B1: '',
            B1A: '',
            B1AOther: '',
            B2: '',
            B3: '',
            B31: '',
            B32: '',
            B33: '',
            B34: '',
            B35: '',
            B4: '',
            B51: '',
            B52Type: '',
            B52Section1: '',
            B52Section2: '',
            B52Section3: '',
            B52Section4: '',
            B52Section5: '',
            // C1:'',
            // C2:'',
            // C3:'',
            C31: ''
        };

        //保存问卷
        function saveSurvey(type) {
            var salesSurveyAnswers = {
                Name: surveyAnswers.Name,
                S1: surveyAnswers.S1,
                S1Other: surveyAnswers.S1Other,
                S2: surveyAnswers.S2,
                S2Other: surveyAnswers.S2Other,
                S3: surveyAnswers.S3,
                S4: surveyAnswers.S4,
                S5: surveyAnswers.S5,
                S6: surveyAnswers.S6,
                A1: surveyAnswers.A1,
                A2: surveyAnswers.A2,
                A3: surveyAnswers.A3,
                A31: surveyAnswers.A31,
                A42A1: surveyAnswers.A42A1,
                A42A2: surveyAnswers.A42A2,
                A42A3: surveyAnswers.A42A3,
                A42A4: surveyAnswers.A42A4,
                A42A5: surveyAnswers.A42A5,
                A42B1: surveyAnswers.A42B1,
                A42B2: surveyAnswers.A42B2,
                A42B3: surveyAnswers.A42B3,
                A42B4: surveyAnswers.A42B4,
                A42B5: surveyAnswers.A42B5,
                C1: surveyAnswers.C1,
                C2: surveyAnswers.C2,
                C3: surveyAnswers.C3,
                C3Other: surveyAnswers.C3Other
            };
            var afterSalesSurveyAnswer = {
                Name: surveyAnswers.Name,
                S1: surveyAnswers.S1,
                S1Other: surveyAnswers.S1Other,
                S2: surveyAnswers.S2,
                S2Other: surveyAnswers.S2Other,
                S3: surveyAnswers.S3,
                S4: surveyAnswers.S4,
                S5: surveyAnswers.S5,
                B1: surveyAnswers.B1,
                B1A: surveyAnswers.B1A,
                B1AOther: surveyAnswers.B1AOther,
                B2: surveyAnswers.B2,
                B3: surveyAnswers.B3,
                B31: surveyAnswers.B31,
                B32: surveyAnswers.B32,
                B33: surveyAnswers.B33,
                B34: surveyAnswers.B34,
                B35: surveyAnswers.B35,
                B4: surveyAnswers.B4,
                B52Type: surveyAnswers.B52Type,
                B52Section1: surveyAnswers.B52Section1,
                B52Section2: surveyAnswers.B52Section2,
                B52Section3: surveyAnswers.B52Section3,
                B52Section4: surveyAnswers.B52Section4,
                B52Section5: surveyAnswers.B52Section5,
                C1: surveyAnswers.C1,
                C2: surveyAnswers.C2,
                C3: surveyAnswers.C3,
                C31: surveyAnswers.C31
            };
            var dataArr = [salesSurveyAnswers, afterSalesSurveyAnswer];
            var url = ['@app/?r=nps-survey/save-nps-sales-survey', '@app/?r=nps-survey/save-nps-after-sales-survey'];
            // 表单验证
            if (!formCheck[type]()) {
                return;
            }
            $.ajax({
                url: url[type],
                type: 'post',
                data: dataArr[type],
                succeed: function (data) {
                    console.log(data);
                    if (data.code === 200) {
                        // Todo
                        // 跳转
                        // 成功提醒
                    }
                    else {
                        // Todo
                        // 失败提醒
                        alert('提交失败，重新提交');
                    }
                }
            });
        }

        //生成测试页面
        //handleData(NPS_DATA, '#content_1', '1');
        //表单验证
        var formCheck = [
            salesSurveyAnswersCheck,
            afterSalesSurveyAnswersCheck
        ];

        function salesSurveyAnswersCheck() {
            if (surveyAnswers.name === '') {
                alert('请填写姓名');
                return false;
            }
            if (surveyAnswers.S1 === '') {
                alert('请填写 S1');
                return false;
            }
            if (surveyAnswers.S2 === '') {
                alert('请填写 S2');
                return false;
            }
            if (surveyAnswers.S3 === '') {
                alert('请填写 S3');
                return false;
            }
            if (surveyAnswers.S4 === '') {
                alert('请填写 S4');
                return false;
            }
            if (surveyAnswers.S5 === '') {
                alert('请填写 S5');
                return false;
            }
            if (surveyAnswers.S6 === '') {
                alert('请填写 S6');
                return false;
            }
            if (surveyAnswers.A1 === '') {
                alert('请填写 A1');
                return false;
            }
            if (surveyAnswers.A2 === '') {
                alert('请填写 A2');
                return false;
            }
            if (surveyAnswers.A3 === '') {
                alert('请填写 A3');
                return false;
            }
            if (surveyAnswers.A31 === '') {
                alert('请填写 A31');
                return false;
            }
            if (surveyAnswers.A42A1 === '') {
                alert('请填写 A42A1');
                return false;
            }
            if (surveyAnswers.A42A2 === '') {
                alert('请填写 A42A2');
                return false;
            }
            if (surveyAnswers.A42A3 === '') {
                alert('请填写 A42A3');
                return false;
            }
            if (surveyAnswers.A42A4 === '') {
                alert('请填写 A42A4');
                return false;
            }
            if (surveyAnswers.A42A5 === '') {
                alert('请填写 A42A5');
                return false;
            }
            if (surveyAnswers.A42B1 === '') {
                alert('请填写 A42B1');
                return false;
            }
            if (surveyAnswers.A42B2 === '') {
                alert('请填写 A42B2');
                return false;
            }
            if (surveyAnswers.A42B3 === '') {
                alert('请填写 A42B3');
                return false;
            }
            if (surveyAnswers.A42B4 === '') {
                alert('请填写 A42B4');
                return false;
            }
            if (surveyAnswers.A42B5 === '') {
                alert('请填写 A42B5');
                return false;
            }
            if (surveyAnswers.C1 === '') {
                alert('请填写 C1');
                return false;
            }
            if (surveyAnswers.C2 === '') {
                alert('请填写 C2');
                return false;
            }
            if (surveyAnswers.C3 === '') {
                alert('请填写 C3');
                return false;
            }
            return true;
        }

        function afterSalesSurveyAnswersCheck() {
            if (surveyAnswers.name === '') {
                alert('请填写姓名');
                return false;
            }
            if (surveyAnswers.S1 === '') {
                alert('请填写 S1');
                return false;
            }
            if (surveyAnswers.S2 === '') {
                alert('请填写 S2');
                return false;
            }
            if (surveyAnswers.S3 === '') {
                alert('请填写 S3');
                return false;
            }
            if (surveyAnswers.S4 === '') {
                alert('请填写 S4');
                return false;
            }
            if (surveyAnswers.S5 === '') {
                alert('请填写 S5');
                return false;
            }
            if (surveyAnswers.B1 === '') {
                alert('请填写 B1');
                return false;
            }
            if (surveyAnswers.B1A === '') {
                alert('请填写 B1A');
                return false;
            }
            if (surveyAnswers.B2 === '') {
                alert('请填写 B2');
                return false;
            }
            if (surveyAnswers.B4 === '') {
                alert('请填写 B4');
                return false;
            }
            if (surveyAnswers.B51 === '') {
                alert('请填写 B51');
                return false;
            }
            if (surveyAnswers.B52type === '') {
                alert('请填写 B52type');
                return false;
            }
            if (surveyAnswers.C1 === '') {
                alert('请填写 C1');
                return false;
            }
            if (surveyAnswers.C2 === '') {
                alert('请填写 C2');
                return false;
            }
            if (surveyAnswers.C3 === '') {
                alert('请填写 C3');
                return false;
            }
        }

        // 选择题事件绑定
        function handle_bind() {
            // 输入
            input_selector.forEach(function (el) {
                console.log(el);
                $(el).on('keyup', function () {
                    var qnum = $(this).data('qnum');
                    console.log(qnum);
                    console.log($(this).val());
                    surveyAnswers[qnum] = $(this).val();
                    console.log(surveyAnswers);
                });
            });
            // 单选
            single_selector.forEach(function (el) {
                console.log(el);
                $(el).on('click', function () {
                    var qnum = $(this).data('qnum');
                    var qid = $(this).data('qid');
                    surveyAnswers[qnum] = String(qid);
                    console.log(surveyAnswers);
                    //选中样式
                    console.log($(this)[0].tagName);
                    switch ($(this)[0].tagName) {
                        case "LI":
                            $(this).addClass('active').siblings().removeClass('active');
                            break;
                    }
                });
            });
        }

        //事件绑定
        function eventBind() {
            "use strict";
            $('.submitBtn').on('click', function () {
                var type = parseInt($(this).attr("data-type")) - 1;
                console.log(type);
                saveSurvey(type);
            });
            //选择后变化的样式
            $('.agree-select-table ul li').on('click', function () {
                var This = $(this);
                This.addClass('on').siblings().removeClass('on');
            });
            $('.brand-select-table tr').on('click', function () {
                var This = $(this);
                This.addClass('on').siblings().removeClass('on');
            });
        }

        //进入调查
        $("#enterServer").on('click', function () {
            show_page('.wrap2');
        });
        // 保存姓名； 进入 第二页
        $('#checkUserName').on('click', function () {
            if ($('.input-name').val().trim() === '') {
                alert('请输入姓名');
                return;
            }
            show_page('.wrap3');
        });
        //进入销售问卷
        $sale.on('click', function () {
            getSurvey('1');
        });
        //进入售后问卷
        $afterSales.on('click', function () {
            getSurvey('2');
        });
    });

}());
"if(sale){
"  1 是
"  S1:1
"  S1Other:
"  2 否
"  S1:2
"  S1Other: 12312312
"}elseif(afterSales){
"      1 是
"      S1:49
"      S1Other:
"      2 否
"      S1:50
"      S1Other: 2017-12-31
"}
