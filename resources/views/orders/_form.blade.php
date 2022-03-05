<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $order->title) }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Cost</label>
            <input type="text" name="cost" class="form-control @error('cost') is-invalid @enderror"
               value="{{ old('cost', $order->cost) }}">
            @error('cost')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $order->description) }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Customer</label>
            <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                <option value="">Select a customer...</option>
                @foreach ($customers as $customer)
                   <option value="{{ $customer->id }}" {{ $customer->id === $order->customer_id ? "selected":"" }}>{{ $customer->first_name }}</option>
                @endforeach
            </select>
            @error('customer_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Tags</label>
            <select name="tags[]" class="form-control @error('tags') is-invalid @enderror" multiple>
                @foreach ($tags as $tag)
                   <option value="{{ $tag->id }}" {{ isset($orderTagIds) && in_array($tag->id, $orderTagIds) ? "selected":"" }}>{{ $tag->name }}</option>
                @endforeach
                @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </select>
        </div>
    </div>
</div>
