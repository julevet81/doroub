<!-- Modal -->
<div class="modal fade" id="destructModal{{ $device->id }}" tabindex="-1"
    aria-labelledby="destructModalLabel{{ $device->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('devices.destruct', $device->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content" style="font-size: xx-large">
                <div class="modal-header">
                    <h5 class="modal-title" id="destructModalLabel{{ $device->id }}">تدمير الجهاز</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>الاسم:</strong> {{ $device->name }}</p>
                    <p><strong>الباركود:</strong> {{ $device->barcode }}</p>
                    <p><strong>الرقم التسلسلي:</strong> {{ $device->serial_number }}</p>
                    <p><strong>التاريخ:</strong> {{ date('Y-m-d') }}</p>

                    <div class="mb-3">
                        <label for="destruction_reason{{ $device->id }}" class="form-label">سبب التدمير</label>
                        <textarea name="destruction_reason" id="destruction_reason{{ $device->id }}"
                            class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">تأكيد التدمير</button>
                </div>
            </div>
        </form>
    </div>
</div>
