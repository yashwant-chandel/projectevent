@extends('admin_layout/index')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Event List</h4>
                                               
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Title</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Description</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Start Date</span>
                                                                    <span>Close Date</span>
                                                                </span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-id"><span class="">RSVP Code</span></th>
                                                        <th class="tb-tnx-amount is-alt">
                                                            <span class="tb-tnx-total">Event Type</span>
                                                            <span class="tb-tnx-status d-none d-md-inline-block">Start Time</span>
                                                        </th>
                                                        <th class="tb-tnx-action">
                                                            <span>&nbsp;</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <?php $count = 1;  ?>
                                                @foreach($events as $ev)
                                                <tbody>
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            <a href="#"><span>{{ $count ++; }}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">{{ $ev->title ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                <span class="date">{{ $ev->session['start_date'] ?? '' }}</span>
                                                                <span class="date">{{ $ev->session['close_date'] ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-id">
                                                            <a href="{{ url($ev->rsvp_code) }}" target=”_blank” ><span>{{ $ev->rsvp_code ?? '' }}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-amount is-alt">
                                                            <div class="tb-tnx-total">
                                                                <span class="amount">{{ $ev->session_type ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-status">
                                                                <span class="amount">{{ $ev->session['start_time'] ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-action">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="{{ url('admin-dashboard/edit/'.$ev->rsvp_code) }}">Edit</a></li>
                                                                        <li><a href="{{ url('admin-dashboard/view/'.$ev->rsvp_code) }}">Register list</a></li>
                                                                        <li><a link="{{ url('/admin-dashboard/event/delete/'.$ev->id) }}" class="remove">Remove</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div><!-- .card-preview -->
                                    </div><!-- nk-block -->
                                    <script>
                                        $('.remove').click(function(){
                                        link = $(this).attr('link');
                                        Swal.fire({
                                        title: 'Do you want to delete this event?',
                                        showCancelButton: true,
                                        confirmButtonText: 'yes',
                                        confirmButtonColor: '#008000',
                                        cancelButtonText: 'no',
                                        cancelButtonColor: '#d33',
                                        }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = link;
                                        } 
                                        }); 

                                    });
                                    </script>

@endsection