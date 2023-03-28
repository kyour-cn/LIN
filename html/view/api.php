<div class="row">
    <div class="col-sm-7 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">科佑儿LIN下单系统-API对接文档</div>
                </div>
            </div>
            <div class="card-body">
                <blockquote>
                    <p>本文档只实用于本系统，请正确填写接口地址！
                    </p>
                    <footer>
                    每个用户都有一个随机生成的8位随机唯一秘钥，简称key。只可重置，不可修改！<br>
                    你可以去<a href="./view.php?user"><font color="red">用户中心(点这里)</font></a>查看和重置！
                    </footer>
                </blockquote>
                <div class="sub-title">API统一说明 - about</div>
                <p>
                    - API通过http协议进行基础指令传递来完成相应的功能的接口工具！<br>
                    本接口的一些介绍:<br>
                    <b>run参数 : API处理结果返回类型！</b><br>
                    run=code 返回处理结果数字代码！<br>
                    如 : 1
                    <br>
                    <i>run=msg 返回处理结果数字代码！</i><br>
                    如 : 商品购买成功
                    <br>
                    run=json 返回处理结果的json字符串<br>
                    如 : {code="1",msg="商品购买成功",name="商品名",money="金额"}
                    <br><br>
                    <i>返回code(结果数字代码)说明！</i><br>
                    0 : 请求未处理，原因：秘钥不正确，商品不存在，商品参数数量不正确<br>
                    -1 : 余额不足以进行该操作！
                </p>
                <div class="sub-title">在线下单 - order</div>
                <p>
                    <h5>api.php?order</h5>
                    <b>key </b>: 用户秘钥，必填<br>
                    <b>tid </b>: 商品id<br>
                    <b>input</b> : 传入参数值(下单数据)，多个用|符号隔开<br>
                    --如 input=123  多个参数  input=123|456|xxx<br>
                    --参数数量必须与商品设定的个数相同！<br>
                    <b>num</b> : 购买数量，默认1，按照商品规则填写！<br>
                    <br>
                    <b>示例:http://<?php echo $this_host; ?>/api.php?order<br>
                    key=xx&tid=xx&input=xx&num=xx
                    </b>
                </p>
                <div class="sub-title"><未完善>获取商品列表 - tools</div>
                <h5>api.php?tools</h5>
                <p>http://<?php echo $this_host; ?>/api.php?tools</p>
                返回json数据
            </div>
        </div>
    </div>
</div>



