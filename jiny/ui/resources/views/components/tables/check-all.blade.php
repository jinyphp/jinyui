{{-- 전체 선택 --}}
{{--
<div class="form-check">
        <input type="checkbox" class="form-check-input" id="all_checks" name="all_checks" @click="selectAllCheckbox($event);">
        <label class="form-check-label" for="all_checks">&nbsp;</label>
</div>
--}}
{!! \Jiny\UI\Table::instance()->allCheck() !!}
