@extends('emails/layouts/default')

@section('content')
    <p>{{ trans('mail.hello') }} {{ $data['first_name'] }},</p>


    <p>{{ trans('mail.manager_approve') }}</p>

    <table>
        @if (isset($data['assigned_to']))
            <tr>
                <td>
                    {{trans('mail.managee')}}
                </td>
                <td>
                    <strong>{{$data['assigned_to']}}</strong>
                </td>
            </tr>
        @endif

        <tr>
            <td>
                {{ trans('mail.asset_name') }}
            </td>
            <td>
                <strong>{{ $data['item_name'] }}</strong>
            </td>
        </tr>
        @if (isset($data['item_tag']))
            <tr>
                <td>
                    {{ trans('mail.asset_tag') }}
                </td>
                <td>
                    <strong>{{ $data['item_tag'] }}</strong>
                </td>
            </tr>
        @endif
        @if (isset($data['item_serial']))
            <tr>
                <td>
                    {{ trans('mail.serial') }}
                </td>
                <td>
                    <strong>{{ $data['item_serial'] }}</strong>
                </td>
            </tr>
        @endif
        <tr>
            <td>
                {{ trans('mail.checkout_date') }}
            </td>
            <td>
                <strong>{{ $data['checkout_date'] }}</strong>
            </td>
        </tr>

        @if (isset($data['note']))
            <tr>
                <td>
                    {{ trans('mail.additional_notes') }}
                </td>
                <td>
                    <strong>{{ $data['note'] }}</strong>
                </td>
            </tr>
        @endif
    </table>
    <p>
        @if (($data['require_acceptance']==1) && ($data['eula']!=''))

            {{ trans('mail.read_the_terms_and_click') }}

        @elseif (($data['require_acceptance']==1) && ($data['eula']==''))

            {{ trans('mail.click_on_the_link_asset') }}

        @elseif (($data['require_acceptance']==0) && ($data['eula']!=''))

            {{ trans('mail.read_the_terms_and_approve') }}

        @endif

    </p>

    <p><blockquote>{!! $data['eula'] !!}</blockquote></p>

    @if ($data['require_acceptance']==1)
        <p><strong><a href="{{ config('app.url') }}/account/approve-asset/{{ $data['log_id'] }}">{{ trans('mail.i_have_confirmed') }}</a></strong></p>
    @endif

    <p>Asset Management</p>
@stop
