@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('post.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input
                    value="{{old('title')}}"
                    type="text" name="title" class="form-control" id="title" placeholder="title">
                @error('title')
                <p class="text-bg-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea name="content" type="text" class="form-control" id="content"
                          placeholder="content">{{old('content')}}</textarea>
                @error('content')
                <p class="text-bg-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input name="image" value="{{old('image')}}" type="text" class="form-control" id="image"
                       placeholder="image">
                @error('image')
                <p class="text-bg-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="Category">Category</label>
                <select class="form-control" name="category_id" id="Category">
                    @foreach($categories as $category)
                        <option
                            {{ old('category_id') == $category->id ? 'selected': '' }}
                            value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select multiple class="form-control" id="tags" name="tags[]">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">create</button>
        </form>
    </div>
@endsection
