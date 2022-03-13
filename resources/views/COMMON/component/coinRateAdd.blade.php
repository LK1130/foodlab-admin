        @csrf
        <div class="rowInput">
            <label for="coin">{{ __('messageZY.coin') }}</label>
            <div class="input-group mb-3">
                <input type="text" id="coin" value="1" class="form-control" disabled>
            </div>
        </div>
        <div class="rowInput">
            <label for="kyat">{{ __('messageZY.kyat') }}</label>
            <div class="input-group mb-3">
                <input type="number" id="kyat" name="kyat" class="form-control">
                @error('kyat')
                    <li class="text-danger ">{{ $message }}</li>
                @enderror
            </div>
        </div>
        <div class="rowInput">
            <label for="note">{{ __('messageZY.note') }}</label>
            <div class="input-group mb-3">
                <textarea name="note" class="form-control" id="note" rows="10"></textarea>

                @error('note')
                    <li class="text-danger ">{{ $message }}</li>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btncust text-light active">{{ __('messageZY.change') }}</button>
