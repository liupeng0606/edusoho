webpackJsonp([10],{cyWR:function(n,t,e){"use strict";Object.defineProperty(t,"__esModule",{value:!0});e("eqfM");var i=e("/QYm"),a=e("Dd8w"),c=e.n(a),s=(e("gyMJ"),e("NYxO")),o={data:function(){return{nickname:"",confirmFlag:!1}},computed:c()({btnDisable:function(){return 0===this.nickname.length||!this.confirmFlag}},Object(s.d)({isLoading:function(n){return n.isLoading}})),created:function(){var n=this.$route.query.nickname;n&&(this.nickname=n)},watch:{nickname:function(){/^([\u4E00-\uFA29]|[a-zA-Z0-9_.·])*$/i.test(this.nickname)?this.confirmFlag=!0:(Object(i.a)("仅支持中文字、英文字母、数字及_ . ·"),this.confirmFlag=!1)}},methods:c()({},Object(s.b)(["setNickname"]),{modifyNickname:function(){var n=this;this.confirmFlag&&this.setNickname({nickname:this.nickname}).then(function(){i.a.success("修改成功"),n.$router.go(-1)}).catch(function(n){i.a.fail(n.message)})}})},r={render:function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("div",{staticClass:"my_setting-nickname"},[n.isLoading?e("e-loading"):n._e(),n._v(" "),e("van-field",{staticClass:"my_setting-nickname--input",attrs:{placeholder:"请修改您的用户名"},model:{value:n.nickname,callback:function(t){n.nickname=t},expression:"nickname"}}),n._v(" "),e("van-button",{staticClass:"primary-btn my_setting-nickname—-btn",attrs:{type:"default",disabled:n.btnDisable},on:{click:n.modifyNickname}},[n._v("确定")])],1)},staticRenderFns:[]},m=e("VU/8")(o,r,!1,null,null,null);t.default=m.exports}});