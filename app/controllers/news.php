<?php

class news extends Controller
{
    public $request;
    public $activemenu;
    function __construct()
    {
        $this->request = $_REQUEST;
        $this->activemenu = $this->request['url'];
    }
    function index($args = [])
    {

        $this->view('news/index');
    }

    function ican4consumers_jetpay_team_reduce_chargebacks($args = [])
    {
        $this->view('news/contents/ican4consumers-jetpay-team-reduce-chargebacks');
    }

    function how_to_report_internet_fraud($args = [])
    {
        $this->view('news/contents/how-to-report-internet-fraud');
    }

    function what_to_do_request_a_refund($args = [])
    {
        $this->view('news/contents/what-to-do-request-a-refund');
    }

    function four_great_ways_to_request_a_refund($args = [])
    {
        $this->view('news/contents/4-great-ways-to-request-a-refund');
    }

    function what_is_consumer_advocacy_and_why_do_you_need_it($args = [])
    {
        $this->view('news/contents/consumer-advocacy');
    }

    function ican4consumers_services_provides_chargeback_relief_for_online_merchant($args = [])
    {
        $this->view('news/contents/chargeback-relief-for-online-merchant');
    }
}
