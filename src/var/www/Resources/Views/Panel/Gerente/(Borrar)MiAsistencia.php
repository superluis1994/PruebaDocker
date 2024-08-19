<link rel="stylesheet" href="<?= $utils->assets("Css/CalenMain.css") ?>" />
<link rel="stylesheet" href="<?= $utils->assets("Css/dayGridmain.css") ?>" />
<link rel="stylesheet" href="<?= $utils->assets("Css/TimefridMain.css") ?>" />
<link rel="stylesheet" href="<?= $utils->assets("Css/ListMain.css") ?>" />
<div class="conatiner-fluid content-inner mt-n5 py-0 mt-3">
    <div>
        <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h4 class="mb-0">Calender</h4>
                            </div>
                            <div class="card-action">
                                <a href="#" class="btn btn-primary" role="button">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>             -->
        <div class="row ">
            <div class="col-lg-12 mt-4">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="card  ">
                            <div class="card-body">
                                <div id="calendar1" class="calendar-s fc fc-ltr fc-unthemed" style="">
                                    <div class="fc-toolbar fc-header-toolbar">
                                        <div class="fc-left">
                                            <div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-button-primary" aria-label="prev"><span class="fc-icon fc-icon-chevron-left"></span></button><button type="button" class="fc-next-button fc-button fc-button-primary" aria-label="next"><span class="fc-icon fc-icon-chevron-right"></span></button></div><button type="button" class="fc-today-button fc-button fc-button-primary">today</button>
                                        </div>
                                        <div class="fc-center">
                                            <h2>June 2024</h2>
                                        </div>
                                        <div class="fc-right">
                                            <div class="fc-button-group"><button type="button" class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active">month</button><button type="button" class="fc-timeGridWeek-button fc-button fc-button-primary">week</button><button type="button" class="fc-timeGridDay-button fc-button fc-button-primary">day</button><button type="button" class="fc-listWeek-button fc-button fc-button-primary">list</button></div>
                                        </div>
                                    </div>
                                    <div class="fc-view-container">
                                        <div class="fc-view fc-dayGridMonth-view fc-dayGrid-view" style="">
                                            <table class="">
                                                <thead class="fc-head">
                                                    <tr>
                                                        <td class="fc-head-container fc-widget-header">
                                                            <div class="fc-row fc-widget-header">
                                                                <table class="">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th>
                                                                            <th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th>
                                                                            <th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th>
                                                                            <th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th>
                                                                            <th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th>
                                                                            <th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th>
                                                                            <th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody class="fc-body">
                                                    <tr>
                                                        <td class="fc-widget-content">
                                                            <div class="fc-scroller fc-day-grid-container" style="overflow: hidden auto; height: auto;">
                                                                <div class="fc-day-grid">
                                                                    <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 136px;">
                                                                        <div class="fc-bg">
                                                                            <table class="">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fc-day fc-widget-content fc-sun fc-other-month fc-future" data-date="2024-05-26"></td>
                                                                                        <td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2024-05-27"></td>
                                                                                        <td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2024-05-28"></td>
                                                                                        <td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2024-05-29"></td>
                                                                                        <td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2024-05-30"></td>
                                                                                        <td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2024-05-31"></td>
                                                                                        <td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-06-01"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="fc-content-skeleton">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td class="fc-day-top fc-sun fc-other-month fc-future" data-date="2024-05-26"><span class="fc-day-number">26</span></td>
                                                                                        <td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2024-05-27"><span class="fc-day-number">27</span></td>
                                                                                        <td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2024-05-28"><span class="fc-day-number">28</span></td>
                                                                                        <td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2024-05-29"><span class="fc-day-number">29</span></td>
                                                                                        <td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2024-05-30"><span class="fc-day-number">30</span></td>
                                                                                        <td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2024-05-31"><span class="fc-day-number">31</span></td>
                                                                                        <td class="fc-day-top fc-sat fc-future" data-date="2024-06-01"><span class="fc-day-number">1</span></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end" style="background-color:rgba(58,87,232,0.2);border-color:rgba(58,87,232,1);color:rgba(58,87,232,1)">
                                                                                                <div class="fc-content"><span class="fc-time">5:30a</span> <span class="fc-title">Repeating Event</span></div>
                                                                                            </a></td>
                                                                                        <td></td>
                                                                                        <td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end" style="background-color:rgba(58,87,232,0.2);border-color:rgba(58,87,232,1);color:rgba(58,87,232,1)">
                                                                                                <div class="fc-content"><span class="fc-time">5:30a</span> <span class="fc-title">Repeating Event</span></div>
                                                                                            </a></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 136px;">
                                                                        <div class="fc-bg">
                                                                            <table class="">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-06-02"></td>
                                                                                        <td class="fc-day fc-widget-content fc-mon fc-future" data-date="2024-06-03"></td>
                                                                                        <td class="fc-day fc-widget-content fc-tue fc-future" data-date="2024-06-04"></td>
                                                                                        <td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-06-05"></td>
                                                                                        <td class="fc-day fc-widget-content fc-thu fc-future" data-date="2024-06-06"></td>
                                                                                        <td class="fc-day fc-widget-content fc-fri fc-future" data-date="2024-06-07"></td>
                                                                                        <td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-06-08"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="fc-content-skeleton">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td class="fc-day-top fc-sun fc-future" data-date="2024-06-02"><span class="fc-day-number">2</span></td>
                                                                                        <td class="fc-day-top fc-mon fc-future" data-date="2024-06-03"><span class="fc-day-number">3</span></td>
                                                                                        <td class="fc-day-top fc-tue fc-future" data-date="2024-06-04"><span class="fc-day-number">4</span></td>
                                                                                        <td class="fc-day-top fc-wed fc-future" data-date="2024-06-05"><span class="fc-day-number">5</span></td>
                                                                                        <td class="fc-day-top fc-thu fc-future" data-date="2024-06-06"><span class="fc-day-number">6</span></td>
                                                                                        <td class="fc-day-top fc-fri fc-future" data-date="2024-06-07"><span class="fc-day-number">7</span></td>
                                                                                        <td class="fc-day-top fc-sat fc-future" data-date="2024-06-08"><span class="fc-day-number">8</span></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 136px;">
                                                                        <div class="fc-bg">
                                                                            <table class="">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-06-09"></td>
                                                                                        <td class="fc-day fc-widget-content fc-mon fc-future" data-date="2024-06-10"></td>
                                                                                        <td class="fc-day fc-widget-content fc-tue fc-future" data-date="2024-06-11"></td>
                                                                                        <td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-06-12"></td>
                                                                                        <td class="fc-day fc-widget-content fc-thu fc-future" data-date="2024-06-13"></td>
                                                                                        <td class="fc-day fc-widget-content fc-fri fc-future" data-date="2024-06-14"></td>
                                                                                        <td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-06-15"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="fc-content-skeleton">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td class="fc-day-top fc-sun fc-future" data-date="2024-06-09"><span class="fc-day-number">9</span></td>
                                                                                        <td class="fc-day-top fc-mon fc-future" data-date="2024-06-10"><span class="fc-day-number">10</span></td>
                                                                                        <td class="fc-day-top fc-tue fc-future" data-date="2024-06-11"><span class="fc-day-number">11</span></td>
                                                                                        <td class="fc-day-top fc-wed fc-future" data-date="2024-06-12"><span class="fc-day-number">12</span></td>
                                                                                        <td class="fc-day-top fc-thu fc-future" data-date="2024-06-13"><span class="fc-day-number">13</span></td>
                                                                                        <td class="fc-day-top fc-fri fc-future" data-date="2024-06-14"><span class="fc-day-number">14</span></td>
                                                                                        <td class="fc-day-top fc-sat fc-future" data-date="2024-06-15"><span class="fc-day-number">15</span></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 136px;">
                                                                        <div class="fc-bg">
                                                                            <table class="">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-06-16"></td>
                                                                                        <td class="fc-day fc-widget-content fc-mon fc-future" data-date="2024-06-17"></td>
                                                                                        <td class="fc-day fc-widget-content fc-tue fc-future" data-date="2024-06-18"></td>
                                                                                        <td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-06-19"></td>
                                                                                        <td class="fc-day fc-widget-content fc-thu fc-future" data-date="2024-06-20"></td>
                                                                                        <td class="fc-day fc-widget-content fc-fri fc-future" data-date="2024-06-21"></td>
                                                                                        <td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-06-22"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="fc-content-skeleton">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td class="fc-day-top fc-sun fc-future" data-date="2024-06-16"><span class="fc-day-number">16</span></td>
                                                                                        <td class="fc-day-top fc-mon fc-future" data-date="2024-06-17"><span class="fc-day-number">17</span></td>
                                                                                        <td class="fc-day-top fc-tue fc-future" data-date="2024-06-18"><span class="fc-day-number">18</span></td>
                                                                                        <td class="fc-day-top fc-wed fc-future" data-date="2024-06-19"><span class="fc-day-number">19</span></td>
                                                                                        <td class="fc-day-top fc-thu fc-future" data-date="2024-06-20"><span class="fc-day-number">20</span></td>
                                                                                        <td class="fc-day-top fc-fri fc-future" data-date="2024-06-21"><span class="fc-day-number">21</span></td>
                                                                                        <td class="fc-day-top fc-sat fc-future" data-date="2024-06-22"><span class="fc-day-number">22</span></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 136px;">
                                                                        <div class="fc-bg">
                                                                            <table class="">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-06-23"></td>
                                                                                        <td class="fc-day fc-widget-content fc-mon fc-future" data-date="2024-06-24"></td>
                                                                                        <td class="fc-day fc-widget-content fc-tue fc-future" data-date="2024-06-25"></td>
                                                                                        <td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-06-26"></td>
                                                                                        <td class="fc-day fc-widget-content fc-thu fc-future" data-date="2024-06-27"></td>
                                                                                        <td class="fc-day fc-widget-content fc-fri fc-future" data-date="2024-06-28"></td>
                                                                                        <td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-06-29"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="fc-content-skeleton">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td class="fc-day-top fc-sun fc-future" data-date="2024-06-23"><span class="fc-day-number">23</span></td>
                                                                                        <td class="fc-day-top fc-mon fc-future" data-date="2024-06-24"><span class="fc-day-number">24</span></td>
                                                                                        <td class="fc-day-top fc-tue fc-future" data-date="2024-06-25"><span class="fc-day-number">25</span></td>
                                                                                        <td class="fc-day-top fc-wed fc-future" data-date="2024-06-26"><span class="fc-day-number">26</span></td>
                                                                                        <td class="fc-day-top fc-thu fc-future" data-date="2024-06-27"><span class="fc-day-number">27</span></td>
                                                                                        <td class="fc-day-top fc-fri fc-future" data-date="2024-06-28"><span class="fc-day-number">28</span></td>
                                                                                        <td class="fc-day-top fc-sat fc-future" data-date="2024-06-29"><span class="fc-day-number">29</span></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 137px;">
                                                                        <div class="fc-bg">
                                                                            <table class="">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-06-30"></td>
                                                                                        <td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2024-07-01"></td>
                                                                                        <td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2024-07-02"></td>
                                                                                        <td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2024-07-03"></td>
                                                                                        <td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2024-07-04"></td>
                                                                                        <td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2024-07-05"></td>
                                                                                        <td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2024-07-06"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="fc-content-skeleton">
                                                                            <table>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td class="fc-day-top fc-sun fc-future" data-date="2024-06-30"><span class="fc-day-number">30</span></td>
                                                                                        <td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2024-07-01"><span class="fc-day-number">1</span></td>
                                                                                        <td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2024-07-02"><span class="fc-day-number">2</span></td>
                                                                                        <td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2024-07-03"><span class="fc-day-number">3</span></td>
                                                                                        <td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2024-07-04"><span class="fc-day-number">4</span></td>
                                                                                        <td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2024-07-05"><span class="fc-day-number">5</span></td>
                                                                                        <td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2024-07-06"><span class="fc-day-number">6</span></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>