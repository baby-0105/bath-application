
<p>{{ auth()->user()->name }}　様</p>
<br>
<p>下記のURLをクリックして新しいメールアドレスを確定してください</p>
<br>
<p>OFLogへのアクセスは以下からお願いします。</p>
<br>
<p>※URLの有効期限は60分です。</p>
{{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
