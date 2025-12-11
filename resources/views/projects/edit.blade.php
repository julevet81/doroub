@extends('dashboard.layouts.master')
@section('title')
  Edit project
@endsection
@section('css')
@endsection

@section('content')
  <!-- row -->
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card" style="font-size: x-large">
        <div class="card-body">

          <form action="{{ route('projects.update', $project->id) }}" method="post" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            @method('PUT')

             <div class="card mb-4 p-3">
            <h4>بيانات المشروع</h4>

            <div class="row">
                <div class="col-md-6">
                    <label>اسم المشروع</label>
                    <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
                </div>

                <div class="col-md-6">
                    <label>نوع المشروع</label>
                    <input type="text" name="type" class="form-control" value="{{ $project->type }}" required>
                </div>

                <div class="col-md-4 mt-3">
                    <label>تاريخ البدء</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}" required>
                </div>

                <div class="col-md-4 mt-3">
                    <label>تاريخ الانتهاء</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $project->end_date }}">
                </div>

                <div class="col-md-4 mt-3">
                    <label>المبلغ</label>
                    <input type="number" name="amount" class="form-control" value="{{ $project->amount }}">
                </div>

                <div class="col-md-4 mt-3">
                    <label>الحالة</label>
                    <select name="status" class="form-control" required>
                        <option value="planned" {{ $project->status == 'planned' ? 'selected' : '' }}>مخطط</option>
                        <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                        <option value="rejected" {{ $project->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                    </select>
                </div>

                <div class="col-12 mt-3">
                    <label>ملاحظات</label>
                    <textarea name="notes" class="form-control">{{ $project->notes }}</textarea>
                </div>
            </div>
        </div>

        <!-- عناصر المساعدة -->
        <div class="card p-3 mb-4">
            <h4>عناصر المساعدة</h4>

            <div id="items-container">

                @foreach($projectItems as $index => $item)
                  <div class="row item-row mt-2 border p-2 rounded">

                    <div class="col-md-5">
                        <label>اسم العنصر</label>
                        <select name="items[{{ $index }}][item_id]" class="form-control" onchange="updateStock(this, {{ $index }})">
                            @foreach($assistanceItems as $ai)
                                <option value="{{ $ai->id }}"
                                    data-stock="{{ $ai->quantity_in_stock }}"
                                    {{ $ai->id == $item->id ? 'selected' : '' }}>
                                    {{ $ai->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>الكمية</label>
                        <input type="number" name="items[{{ $index }}][quantity]" class="form-control" value="{{ $item->pivot->quantity }}" required>
                    </div>

                    <div class="col-md-3">
                        <label>المتبقي في المخزن</label>
                        <input type="text" id="stock-{{ $index }}" class="form-control"
                            value="{{ $item->quantity_in_stock }}" disabled>
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
                    </div>
                  </div>
                @endforeach

            </div>

            <button type="button" class="btn btn-primary mt-3" onclick="addItem()">إضافة عنصر جديد</button>
        </div>

        <!-- المتطوعين -->
        <div class="card p-3 mb-4">
            <h4>فريق المتطوعين</h4>

            <div id="volunteers-container">
                @foreach($projectVolunteers as $index => $vol)
                <div class="row vol-row mt-2 border p-2 rounded">

                    <div class="col-md-5">
                        <label>المتطوع</label>
                        <select name="volunteers[{{ $index }}][id]" class="form-control">
                            @foreach($volunteers as $v)
                                <option value="{{ $v->id }}" {{ $v->id == $vol->id ? 'selected' : '' }}>
                                    {{ $v->full_name }} ({{ $v->membership_id }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label>المنصب</label>
                        <input type="text" name="volunteers[{{ $index }}][position]" class="form-control"
                            value="{{ $vol->pivot->position }}">
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
                    </div>

                </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-success mt-3" onclick="addVolunteer()">إضافة متطوع جديد</button>
        </div>


            <br>

            <button type="submit" class="btn btn-primary" style="font-size: x-large">تحديث البيانات</button>

          </form>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    let items = @json($assistanceItems);
    let volunteersList = @json($volunteers);

    function addItem() {
      let index = document.querySelectorAll('.item-row').length;

      let html = `
          <div class="row item-row mt-2 border p-2 rounded">
              <div class="col-md-5">
                  <label>اسم العنصر</label>
                  <select name="items[${index}][item_id]" class="form-control" onchange="updateStock(this, ${index})">
                      <option value="">اختر</option>
                      ${items.map(i => `<option value="${i.id}" data-stock="${i.quantity_in_stock}">${i.name}</option>`).join('')}
                  </select>
              </div>

              <div class="col-md-3">
                  <label>الكمية</label>
                  <input type="number" name="items[${index}][quantity]" class="form-control" required>
              </div>

              <div class="col-md-3">
                  <label>المتبقي في المخزن</label>
                  <input type="text" id="stock-${index}" class="form-control" disabled>
              </div>

              <div class="col-md-1 d-flex align-items-end">
                  <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
              </div>
          </div>
      `;

      document.getElementById('items-container').insertAdjacentHTML('beforeend', html);
    }

    function updateStock(select, index) {
      let stock = select.options[select.selectedIndex].dataset.stock;
      document.getElementById('stock-' + index).value = stock;
    }

    function addVolunteer() {
      let index = document.querySelectorAll('.vol-row').length;

      let html = `
          <div class="row vol-row mt-2 border p-2 rounded">
              <div class="col-md-5">
                  <label>اسم المتطوع</label>
                  <select name="volunteers[${index}][id]" class="form-control">
                      ${volunteersList.map(v => `<option value="${v.id}">${v.full_name} (${v.membership_id})</option>`).join('')}
                  </select>
              </div>

              <div class="col-md-5">
                  <label>المنصب</label>
                  <input type="text" name="volunteers[${index}][position]" class="form-control">
              </div>

              <div class="col-md-2 d-flex align-items-end">
                  <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
              </div>
          </div>`;

      document.getElementById('volunteers-container').insertAdjacentHTML('beforeend', html);
    }
  </script>

@endsection