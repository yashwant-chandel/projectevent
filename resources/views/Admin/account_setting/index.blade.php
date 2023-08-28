@extends('admin_layout/index')
@section('content')
<div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <span class="preview-title-lg overline-title">Change Password</span>
                                       <form action="{{ url('admin-dashboard/change-password/submitprocc') }}" method="post">
                                                       @csrf
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="oldpassword">Enter Old password</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter your old password">
                                                                </div>
                                                                @if($errors->has('oldpassword'))
                                                                <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                                                                @endif

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="newpassword">Enter new password</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="newpassword" id="newpassword" placeholder="Enter your new password">
                                                                </div>
                                                                @if($errors->has('newpassword'))
                                                                <span class="text-danger">{{ $errors->first('newpassword') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="confirmpassword">Re-enter new password</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Re-enter your new password">
                                                                </div>
                                                                @if($errors->has('confirmpassword'))
                                                                <span class="text-danger">{{ $errors->first('confirmpassword') }}</span>
                                                                @endif
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

@endsection