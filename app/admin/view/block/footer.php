{if condition="input('param.hisi_iframe') || cookie('hisi_iframe')"}
</body>
</html>
{else /}
        </div>
    </div>
    <div class="layui-footer footer">
        <span class="fl">Powered by <a href="http://www.qswlteam.com" target="_blank">全是未来工作室</a> v{:config('hisiphp.version')}</span>
        <span class="fr"> © 2017-2018 <a href="http://www.qswlteam.com" target="_blank">QswlTeam</a> All Rights Reserved.</span>
    </div>
</div>
</body>
</html>
{/if}