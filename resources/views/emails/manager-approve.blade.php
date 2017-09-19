@extends('emails/layouts/default')

@section('content')
    <p>{{ trans('mail.hello') }} {{ $first_name }},</p>


    <p>{{ trans('mail.manager_approve') }}</p>

    <table>
        @if (isset($item->assigned_to))
            <tr>
                <td>
                    {{trans('mail.managee')}}
                </td>
                <td>
                    <strong>{{$item->assigned_to}}</strong>
                </td>
            </tr>
        @endif

        <tr>
            <td>
                {{ trans('mail.asset_name') }}
            </td>
            <td>
                <strong>{{ $item_name }}</strong>
            </td>
        </tr>
        @if (isset($item_tag))
            <tr>
                <td>
                    {{ trans('mail.asset_tag') }}
                </td>
                <td>
                    <strong>{{ $item_tag }}</strong>
                </td>
            </tr>
        @endif
        @if (isset($item_serial))
            <tr>
                <td>
                    {{ trans('mail.serial') }}
                </td>
                <td>
                    <strong>{{ $item_serial }}</strong>
                </td>
            </tr>
        @endif
        <tr>
            <td>
                {{ trans('mail.checkout_date') }}
            </td>
            <td>
                <strong>{{ $checkout_date }}</strong>
            </td>
        </tr>

        @if (isset($note))
            <tr>
                <td>
                    {{ trans('mail.additional_notes') }}
                </td>
                <td>
                    <strong>{{ $note }}</strong>
                </td>
            </tr>
        @endif
    </table>
    <p>
        @if (($require_acceptance==1) && ($eula!=''))

            {{ trans('mail.read_the_terms_and_click') }}

        @elseif (($require_acceptance==1) && ($eula==''))

            {{ trans('mail.click_on_the_link_asset') }}

        @elseif (($require_acceptance==0) && ($eula!=''))

            {{ trans('mail.read_the_terms_and_approve') }}

        @endif

    </p>

    <p><blockquote>{!! $eula !!}</blockquote></p>

    @if ($require_acceptance==1)
        <p><strong><a href="{{ config('app.url') }}/account/approve-asset/{{ $log_id }}">{{ trans('mail.i_have_confirmed') }}</a></strong></p>
    @endif

    <p>{{ $snipeSettings->site_name }}</p>
@stop