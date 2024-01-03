@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Project'])
    <div class="row mt-4 mx-4">
        <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h5 class="mb-0">🖋️ Edit project</h5>
                        </div>
                        <div class="col-6 text-end">
                            <h6 class="mb-0">{{$edit -> created_at -> format('d M Y')}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-lg-0 mt-4 mb-4">
            <div class="card">
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger text-white">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{route('project-update', $edit -> id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group d-flex justify-content-between align-items-center py-2">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold" for="project_name">Project name</label>
                                    <input type="text" name="project_name" class="form-control" placeholder="Your Project" value="{{$edit -> project_name}}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="project_description">Project description</label>
                                    <textarea name="project_description" class="form-control" placeholder="Project Description">{{$edit -> project_description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="prject_description">Project type</label>
                                    <input type="text" name="project_type" class="form-control" placeholder="Project Type" value="{{$edit -> project_type}}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="timeline">Due date</label>
                                    <input type="date" id="datemax" name="timeline" class="form-control" placeholder="Timeline" value="{{$edit -> timeline}}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="link">Links</label>
                                    <input type="url" name="link" class="form-control" placeholder="Your links" value="{{$edit -> link}}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="assets">Assets</label>
                                    <input type="url" name="assets" class="form-control" placeholder="place your assets" value="{{$edit -> assets}}">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="priority">Priority</label>
                                    <select class="form-control" name="priority" placeholder="Pilih">
                                        <option selected value="{{$edit -> priority}}">{{$edit -> priority}}</option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Important">Important</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="status">Status</label>
                                    <select class="form-control" name="status" placeholder="Pilih">
                                        <option selected value="{{$edit -> status}}">{{$edit -> status}}</option>
                                        <option value="Progress">On Progress</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Revision">Revision</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="assignee">Assign to</label>
                                    <select class="form-control" name="assignee" placeholder="Pilih">
                                        <option selected value="{{$edit->assignee->username}}">{{$edit->assignee->username}}</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user -> username}}">{{$user -> username}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="project_image">Add some image (Leave blank if you don't want to fill)</label>
                                    <input class="form-control py-1" type="file" name="project_image" value="{{$edit -> project_image}}">
                                </div>
                            </div>
                            {{-- <div class="col-3">
                                    <img id="imagePreview" src="{{ asset('Flipper.png') }}" class="rounded-circle shadow-lg p-2" style="aspect-ratio: 1/1; width: 100%; object-fit: cover;" alt="hero">
                            </div> --}}
                        </div>
                        <div class="d-flex justify-content-between py-5">
                            <a class="btn btn-danger" href="{{ route('project-index') }}" style="width: 48%"><i class="fi fi-rr-undo me-2"></i> Back</a>
                            <button type="submit" class="btn btn-primary" style="width: 48%"><i class="fi fi-rr-disk me-2"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
