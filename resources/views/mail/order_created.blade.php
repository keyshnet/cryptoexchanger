Ура! Новая заявка на обмен.<br>
<br>
<strong>№ заявки:</strong> {{ $order->id }}<br>
<strong>Направление:</strong> {{ __('Обмен') }} {{ $order->currencyFrom->name }} {{ __('на') }} {{ $order->currencyTo->name }}<br>
<strong>Дата заявки:</strong> {{ $order->created_at }}<br>
<strong>Сумма перевода:</strong> {{ $order->summ_from }} {{ $order->currencyFrom->code }}<br>
<strong>Сумма получения:</strong> {{ $order->summ_to }} {{ $order->currencyTo->code }}<br>
<strong>Статус:</strong> {{ $order->status }}
