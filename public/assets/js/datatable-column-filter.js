function setupColumnFilter({ table, tableName, filterContainerSelector, csrfToken }) {
    console.log(table, tableName, filterContainerSelector);    // جلب الإعدادات من السيرفر
    $.ajax({
        url: `/filters?table_name=${tableName}`,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (savedFilters) {
            $(filterContainerSelector).html(''); // تنظيف القائمة

            table.columns().every(function () {
                const column = this;
                const columnIndex = column.index();
                const columnName = $(column.header()).text() || '#';

                const saved = savedFilters.find(f => f.column_index === columnIndex);
                const isChecked = saved ? saved.is_visible : true;

                // ضبط الرؤية
                column.visible(isChecked);

                // إضافة العنصر إلى القائمة
                const checkboxHtml = `
                    <li>
                        <label>
                            <input type="checkbox"
                                   class="form-check-input column-toggle"
                                   data-column="${columnIndex}"
                                   ${isChecked ? 'checked' : ''}>
                            ${columnName}
                        </label>
                    </li>`;
                $(filterContainerSelector).append(checkboxHtml);
            });
        }
    });

    // عند تغيير الخيار
    $(document).on('change', `${filterContainerSelector} .column-toggle`, function () {
        const columnIndex = $(this).data('column');
        const isChecked = $(this).is(':checked');
        const column = table.column(columnIndex);

        column.visible(isChecked);

        // إرسال التحديث للسيرفر
        $.ajax({
            url: '/filters/update',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                table_name: tableName,
                column_index: columnIndex,
                column_name: table.column(columnIndex).header().innerText || '#',
                is_visible: isChecked ? 1 : 0
            }
        });
    });
}

