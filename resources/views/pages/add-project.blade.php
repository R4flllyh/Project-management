@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Project'])
    <div class="row mt-4 mx-4">
        <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h5 class="mb-0">💡 Add project</h5>
                        </div>
                        <div class="col-6 text-end">
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
                    <form action="{{route('project-store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group d-flex justify-content-between align-items-center py-2">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="project_name">Project name</label>
                                    <input type="text" name="project_name" class="form-control" placeholder="Your Project">
                                    <p class="description py-1">The title must contain a maximum of 50 characters</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="project_description">Project description</label>
                                    <textarea name="project_description" class="form-control" placeholder="Project Description"></textarea>
                                    <p class="description py-1">Give your project a good description so everyone know what's it for</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="prject_description">Project type</label>
                                    <input type="text" name="project_type" class="form-control" placeholder="Project Type">
                                    <p class="description py-1">Give your project type so everyone know what's it for</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="timeline">Due date</label>
                                    <input type="date" id="datemax" name="timeline" class="form-control" placeholder="Timeline">
                                    <p class="description py-1">Give your project due date so everyone know when's it done</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="link">Links</label>
                                    <input type="url" name="link" class="form-control" placeholder="Your links">
                                    <p class="description py-1">Give your project some link so everyone know where the project should be done</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="assets">Assets</label>
                                    <input type="url" name="assets" class="form-control" placeholder="Place your assets">
                                    <p class="description py-1">Give your project some assets so everyone know Materials that need to be done for a project</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="priority">Priority</label>
                                    <select class="form-control" name="priority" placeholder="Pilih">
                                        <option selected>Choose</option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Important">Important</option>
                                    </select>
                                    <p class="description py-1">Give your project a priority so everyone know The project falls into the priority category or not</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="status">Status</label>
                                    <select class="form-control" name="status" placeholder="Pilih">
                                        <option selected>Choose</option>
                                        <option value="Progress">On Progress</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Revision">Revision</option>
                                    </select>
                                    <p class="description py-1">Give your project a status so everyone know what's status of the projects</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="assignee">Assign to</label>
                                    <select class="form-control" placeholder="Pilih" name="user_id">
                                        <option selected>Choose</option>
                                        @foreach ($data as $item)
                                        <option value="{{$item->id}}">{{ $item->username }}</option>
                                        @endforeach
                                    </select>
                                    <p class="description py-1">Give your project a assignee so everyone know Who worked on the project</p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold fs-6" for="project_image">Add some image (Leave blank if you don't want to fill)</label>
                                    <input class="form-control py-1" type="file" name="project_image">
                                    <p class="description py-1">Give your project a image so everyone know what's it for (optional)</p>
                                </div>
                            </div>
                            {{-- <div class="col-3">
                                    <img id="imagePreview" src="{{ asset('Flipper.png') }}" class="rounded-circle shadow-lg p-2" style="aspect-ratio: 1/1; width: 100%; object-fit: cover;" alt="hero">
                            </div> --}}
                        </div>
                        <div class="d-flex justify-content-between py-5">
                            <a class="btn btn-danger" href="{{ route('project-index') }}" style="width: 48%"><i class="fi fi-rr-undo me-2"></i> Back</a>
                            <button type="submit" class="btn btn-primary" style="width: 48%"><i class="fi fi-rr-add-folder me-2"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
