<?php

/**
 * Object HTML Components
 */







function zbx_formatDomId($value) {
	return str_replace(['[', ']'], ['_', ''], $value);
}





define('PAGE_TYPE_HTML',				0);
define('PAGE_TYPE_IMAGE',				1);
define('PAGE_TYPE_JS',					3); // javascript
define('PAGE_TYPE_CSS',					4);
define('PAGE_TYPE_HTML_BLOCK',			5); // simple block of html (as text)
define('PAGE_TYPE_JSON',				6); // simple JSON
define('PAGE_TYPE_JSON_RPC',			7); // api call
define('PAGE_TYPE_TEXT',				9); // simple text
define('PAGE_TYPE_TEXT_RETURN_JSON',	11); // input plaintext output json


// CSS styles
define('ZBX_STYLE_ACTION_BUTTONS', 'action-buttons');
define('ZBX_STYLE_ADM_IMG', 'adm-img');
define('ZBX_STYLE_AVERAGE_BG', 'average-bg');
define('ZBX_STYLE_ARROW_DOWN', 'arrow-down');
define('ZBX_STYLE_ARROW_LEFT', 'arrow-left');
define('ZBX_STYLE_ARROW_RIGHT', 'arrow-right');
define('ZBX_STYLE_ARROW_UP', 'arrow-up');
define('ZBX_STYLE_BLUE', 'blue');
define('ZBX_STYLE_BTN_ADD_FAV', 'btn-add-fav');
define('ZBX_STYLE_BTN_ALT', 'btn-alt');
define('ZBX_STYLE_BTN_TOGGLE_CHEVRON', 'btn-toggle-chevron');
define('ZBX_STYLE_BTN_SPLIT', 'btn-split');
define('ZBX_STYLE_BTN_TOGGLE', 'btn-dropdown-toggle');
define('ZBX_STYLE_BTN_BACK_MAP', 'btn-back-map');
define('ZBX_STYLE_BTN_BACK_MAP_CONTAINER', 'btn-back-map-container');
define('ZBX_STYLE_BTN_BACK_MAP_CONTENT', 'btn-back-map-content');
define('ZBX_STYLE_BTN_BACK_MAP_ICON', 'btn-back-map-icon');
define('ZBX_STYLE_BTN_ACTION', 'btn-action');
define('ZBX_STYLE_BTN_DASHBOARD_CONF', 'btn-dashboard-conf');
define('ZBX_STYLE_BTN_DASHBOARD_NORMAL', 'btn-dashboard-normal');
define('ZBX_STYLE_BTN_DASHBOARD_KIOSKMODE_TOGGLE_SLIDESHOW', 'btn-dashboard-kioskmode-toggle-slideshow');
define('ZBX_STYLE_BTN_DASHBOARD_KIOSKMODE_PREVIOUS_PAGE', 'btn-dashboard-kioskmode-previous-page');
define('ZBX_STYLE_BTN_DASHBOARD_KIOSKMODE_NEXT_PAGE', 'btn-dashboard-kioskmode-next-page');
define('ZBX_STYLE_BTN_DEBUG', 'btn-debug');
define('ZBX_STYLE_BTN_GREY', 'btn-grey');
define('ZBX_STYLE_BTN_INFO', 'btn-info');
define('ZBX_STYLE_BTN_LINK', 'btn-link');
define('ZBX_STYLE_BTN_KIOSK', 'btn-kiosk');
define('ZBX_STYLE_BTN_MIN', 'btn-min');
define('ZBX_STYLE_BTN_REMOVE_FAV', 'btn-remove-fav');
define('ZBX_STYLE_BTN_TIME', 'btn-time');
define('ZBX_STYLE_BTN_TIME_LEFT', 'btn-time-left');
define('ZBX_STYLE_BTN_TIME_OUT', 'btn-time-out');
define('ZBX_STYLE_BTN_TIME_RIGHT', 'btn-time-right');
define('ZBX_STYLE_BTN_WIDGET_ACTION', 'btn-widget-action');
define('ZBX_STYLE_BTN_WIDGET_COLLAPSE', 'btn-widget-collapse');
define('ZBX_STYLE_BTN_WIDGET_EDIT', 'btn-widget-edit');
define('ZBX_STYLE_BTN_WIDGET_EXPAND', 'btn-widget-expand');
define('ZBX_STYLE_BOTTOM', 'bottom');
define('ZBX_STYLE_BROWSER_LOGO_CHROME', 'browser-logo-chrome');
define('ZBX_STYLE_BROWSER_LOGO_FF', 'browser-logo-ff');
define('ZBX_STYLE_BROWSER_LOGO_ED', 'browser-logo-ed');
define('ZBX_STYLE_BROWSER_LOGO_OPERA', 'browser-logo-opera');
define('ZBX_STYLE_BROWSER_LOGO_SAFARI', 'browser-logo-safari');
define('ZBX_STYLE_BROWSER_WARNING_CONTAINER', 'browser-warning-container');
define('ZBX_STYLE_BROWSER_WARNING_FOOTER', 'browser-warning-footer');
define('ZBX_STYLE_CELL', 'cell');
define('ZBX_STYLE_CELL_WIDTH', 'cell-width');
define('ZBX_STYLE_CENTER', 'center');
define('ZBX_STYLE_CHECKBOX_RADIO', 'checkbox-radio');
define('ZBX_STYLE_CLOCK', 'clock');
define('ZBX_STYLE_SYSMAP', 'sysmap');
define('ZBX_STYLE_NAVIGATIONTREE', 'navtree');
define('ZBX_STYLE_CHECKBOX_LIST', 'checkbox-list');
define('ZBX_STYLE_CLOCK_SVG', 'clock-svg');
define('ZBX_STYLE_CLOCK_FACE', 'clock-face');
define('ZBX_STYLE_CLOCK_HAND', 'clock-hand');
define('ZBX_STYLE_CLOCK_HAND_SEC', 'clock-hand-sec');
define('ZBX_STYLE_CLOCK_LINES', 'clock-lines');
define('ZBX_STYLE_COLOR_PICKER', 'color-picker');
define('ZBX_STYLE_COLOR_PREVIEW_BOX', 'color-preview-box');
define('ZBX_STYLE_COLUMN_TAGS_1', 'column-tags-1');
define('ZBX_STYLE_COLUMN_TAGS_2', 'column-tags-2');
define('ZBX_STYLE_COLUMN_TAGS_3', 'column-tags-3');
define('ZBX_STYLE_COMPACT_VIEW', 'compact-view');
define('ZBX_STYLE_CURSOR_POINTER', 'cursor-pointer');
define('ZBX_STYLE_DASHBOARD', 'dashboard');
define('ZBX_STYLE_DASHBOARD_IS_MULTIPAGE', 'dashboard-is-multipage');
define('ZBX_STYLE_DASHBOARD_IS_EDIT_MODE', 'dashboard-is-edit-mode');
define('ZBX_STYLE_DASHBOARD_KIOSKMODE_CONTROLS', 'dashboard-kioskmode-controls');
define('ZBX_STYLE_DASHBOARD_GRID', 'dashboard-grid');
define('ZBX_STYLE_DASHBOARD_NAVIGATION', 'dashboard-navigation');
define('ZBX_STYLE_DASHBOARD_NAVIGATION_CONTROLS', 'dashboard-navigation-controls');
define('ZBX_STYLE_DASHBOARD_NAVIGATION_TABS', 'dashboard-navigation-tabs');
define('ZBX_STYLE_DASHBOARD_PREVIOUS_PAGE', 'dashboard-previous-page');
define('ZBX_STYLE_DASHBOARD_NEXT_PAGE', 'dashboard-next-page');
define('ZBX_STYLE_DASHBOARD_TOGGLE_SLIDESHOW', 'dashboard-toggle-slideshow');
define('ZBX_STYLE_DASHBOARD_WIDGET', 'dashboard-widget');
define('ZBX_STYLE_DASHBOARD_WIDGET_FLUID', 'dashboard-widget-fluid');
define('ZBX_STYLE_DASHBOARD_WIDGET_HEAD', 'dashboard-widget-head');
define('ZBX_STYLE_DASHBOARD_WIDGET_FOOT', 'dashboard-widget-foot');
define('ZBX_STYLE_DASHBOARD_EDIT', 'dashboard-edit');
define('ZBX_STYLE_DASHBOARD_WIDGET_GRAPH_LINK', 'dashboard-widget-graph-link');
define('ZBX_STYLE_DASHED_BORDER', 'dashed-border');
define('ZBX_STYLE_DEBUG_OUTPUT', 'debug-output');
define('ZBX_STYLE_DISABLED', 'disabled');
define('ZBX_STYLE_DISASTER_BG', 'disaster-bg');
define('ZBX_STYLE_DISPLAY_NONE', 'display-none');
define('ZBX_STYLE_DRAG_ICON', 'drag-icon');
define('ZBX_STYLE_PROBLEM_UNACK_FG', 'problem-unack-fg');
define('ZBX_STYLE_PROBLEM_ACK_FG', 'problem-ack-fg');
define('ZBX_STYLE_OK_UNACK_FG', 'ok-unack-fg');
define('ZBX_STYLE_OK_ACK_FG', 'ok-ack-fg');
define('ZBX_STYLE_OVERRIDES_LIST', 'overrides-list');
define('ZBX_STYLE_OVERRIDES_LIST_ITEM', 'overrides-list-item');
define('ZBX_STYLE_OVERRIDES_OPTIONS_LIST', 'overrides-options-list');
define('ZBX_STYLE_PLUS_ICON', 'plus-icon');
define('ZBX_STYLE_DRAG_DROP_AREA', 'drag-drop-area');
define('ZBX_STYLE_TABLE_FORMS_SEPARATOR', 'table-forms-separator');
define('ZBX_STYLE_TABLE_LEFT_BORDER', 'border-left');
define('ZBX_STYLE_TIME_INPUT', 'time-input');
define('ZBX_STYLE_TIME_INPUT_ERROR', 'time-input-error');
define('ZBX_STYLE_TIME_QUICK', 'time-quick');
define('ZBX_STYLE_TIME_QUICK_RANGE', 'time-quick-range');
define('ZBX_STYLE_TIME_SELECTION_CONTAINER', 'time-selection-container');
define('ZBX_STYLE_FILTER_BTN_CONTAINER', 'filter-btn-container');
define('ZBX_STYLE_FILTER_CONTAINER', 'filter-container');
define('ZBX_STYLE_FILTER_HIGHLIGHT_ROW_CB', 'filter-highlight-row-cb');
define('ZBX_STYLE_FILTER_FORMS', 'filter-forms');
define('ZBX_STYLE_FILTER_SPACE', 'filter-space');
define('ZBX_STYLE_FILTER_TRIGGER', 'filter-trigger');
define('ZBX_STYLE_FLH_AVERAGE_BG', 'flh-average-bg');
define('ZBX_STYLE_FLH_DISASTER_BG', 'flh-disaster-bg');
define('ZBX_STYLE_FLH_HIGH_BG', 'flh-high-bg');
define('ZBX_STYLE_FLH_INFO_BG', 'flh-info-bg');
define('ZBX_STYLE_FLH_NA_BG', 'flh-na-bg');
define('ZBX_STYLE_FLH_WARNING_BG', 'flh-warning-bg');
define('ZBX_STYLE_FLOAT_LEFT', 'float-left');
define('ZBX_STYLE_FORM_INPUT_MARGIN', 'form-input-margin');
define('ZBX_STYLE_FORM_FIELDS_INLINE', 'form-fields-inline');
define('ZBX_STYLE_FORM_NEW_GROUP', 'form-new-group');
define('ZBX_STYLE_GRAPH_WRAPPER', 'graph-wrapper');
define('ZBX_STYLE_GREEN', 'green');
define('ZBX_STYLE_GREEN_BG', 'green-bg');
define('ZBX_STYLE_GREY', 'grey');
define('ZBX_STYLE_TEAL', 'teal');
define('ZBX_STYLE_HEADER_TITLE', 'header-title');
define('ZBX_STYLE_HEADER_CONTROLS', 'header-controls');
define('ZBX_STYLE_HEADER_Z_SELECT', 'header-z-select');
define('ZBX_STYLE_HIGH_BG', 'high-bg');
define('ZBX_STYLE_HOR_LIST', 'hor-list');
define('ZBX_STYLE_HOVER_NOBG', 'hover-nobg');
define('ZBX_STYLE_HINTBOX_WRAP', 'hintbox-wrap');
define('ZBX_STYLE_ICON_ACKN', 'icon-ackn');
define('ZBX_STYLE_ICON_CAL', 'icon-cal');
define('ZBX_STYLE_ICON_DEPEND_DOWN', 'icon-depend-down');
define('ZBX_STYLE_ICON_DEPEND_UP', 'icon-depend-up');
define('ZBX_STYLE_ICON_DESCRIPTION', 'icon-description');
define('ZBX_STYLE_ICON_INFO', 'icon-info');
define('ZBX_STYLE_ICON_INVISIBLE', 'icon-invisible');
define('ZBX_STYLE_ICON_USER', 'icon-user');
define('ZBX_STYLE_ICON_USER_GROUP', 'icon-user-group');
define('ZBX_STYLE_ICON_MAINT', 'icon-maint');
define('ZBX_STYLE_ICON_WZRD_ACTION', 'icon-wzrd-action');
define('ZBX_STYLE_ACTION_COMMAND', 'icon-action-command');
define('ZBX_STYLE_ACTION_ICON_CLOSE', 'icon-action-close');
define('ZBX_STYLE_ACTION_ICON_MSG', 'icon-action-msg');
define('ZBX_STYLE_ACTION_ICON_MSGS', 'icon-action-msgs');
define('ZBX_STYLE_ACTION_ICON_SEV_UP', 'icon-action-severity-up');
define('ZBX_STYLE_ACTION_ICON_SEV_DOWN', 'icon-action-severity-down');
define('ZBX_STYLE_ACTION_ICON_SEV_CHANGED', 'icon-action-severity-changed');
define('ZBX_STYLE_ACTION_MESSAGE', 'icon-action-message');
define('ZBX_STYLE_ACTION_ICON_ACK', 'icon-action-ack');
define('ZBX_STYLE_ACTION_ICON_UNACK', 'icon-action-unack');
define('ZBX_STYLE_PROBLEM_GENERATED', 'icon-problem-generated');
define('ZBX_STYLE_PROBLEM_RECOVERY', 'icon-problem-recovery');
define('ZBX_STYLE_ACTIONS_NUM_GRAY', 'icon-actions-number-gray');
define('ZBX_STYLE_ACTIONS_NUM_YELLOW', 'icon-actions-number-yellow');
define('ZBX_STYLE_ACTIONS_NUM_RED', 'icon-actions-number-red');
define('ZBX_STYLE_INACTIVE_BG', 'inactive-bg');
define('ZBX_STYLE_INFO_BG', 'info-bg');
define('ZBX_STYLE_INPUT_COLOR_PICKER', 'input-color-picker');
define('ZBX_STYLE_LAYOUT_KIOSKMODE', 'layout-kioskmode');
define('ZBX_STYLE_LAYOUT_WRAPPER', 'wrapper');
define('ZBX_STYLE_LEFT', 'left');
define('ZBX_STYLE_LINK_ACTION', 'link-action');
define('ZBX_STYLE_LINK_ALT', 'link-alt');
define('ZBX_STYLE_LIST_CHECK_RADIO', 'list-check-radio');
define('ZBX_STYLE_LIST_TABLE', 'list-table');
define('ZBX_STYLE_LIST_TABLE_FOOTER', 'list-table-footer');
define('ZBX_STYLE_LIST_VERTICAL_ACCORDION', 'list-vertical-accordion');
define('ZBX_STYLE_LIST_ACCORDION_FOOT', 'list-accordion-foot');
define('ZBX_STYLE_LIST_ACCORDION_ITEM', 'list-accordion-item');
define('ZBX_STYLE_LIST_ACCORDION_ITEM_OPENED', 'list-accordion-item-opened');
define('ZBX_STYLE_LIST_ACCORDION_ITEM_CLOSED', 'list-accordion-item-closed');
define('ZBX_STYLE_LIST_ACCORDION_ITEM_HEAD', 'list-accordion-item-head');
define('ZBX_STYLE_LIST_ACCORDION_ITEM_BODY', 'list-accordion-item-body');
define('ZBX_STYLE_LOCAL_CLOCK', 'local-clock');
define('ZBX_STYLE_LOG_NA_BG', 'log-na-bg');
define('ZBX_STYLE_LOG_INFO_BG', 'log-info-bg');
define('ZBX_STYLE_LOG_WARNING_BG', 'log-warning-bg');
define('ZBX_STYLE_LOG_HIGH_BG', 'log-high-bg');
define('ZBX_STYLE_LOG_DISASTER_BG', 'log-disaster-bg');
define('ZBX_STYLE_LOGO', 'logo');
define('ZBX_STYLE_MAP_AREA', 'map-area');
define('ZBX_STYLE_MIDDLE', 'middle');
define('ZBX_STYLE_MONOSPACE_FONT', 'monospace-font');
define('ZBX_STYLE_MSG_GOOD', 'msg-good');
define('ZBX_STYLE_MSG_BAD', 'msg-bad');
define('ZBX_STYLE_MSG_WARNING', 'msg-warning');
define('ZBX_STYLE_MSG_GLOBAL_FOOTER', 'msg-global-footer');
define('ZBX_STYLE_MSG_DETAILS', 'msg-details');
define('ZBX_STYLE_MSG_DETAILS_BORDER', 'msg-details-border');
define('ZBX_STYLE_NA_BG', 'na-bg');
define('ZBX_STYLE_NORMAL_BG', 'normal-bg');
define('ZBX_STYLE_NOTIF_BODY', 'notif-body');
define('ZBX_STYLE_NOTIF_INDIC', 'notif-indic');
define('ZBX_STYLE_NOTIF_INDIC_CONTAINER', 'notif-indic-container');
define('ZBX_STYLE_NOTHING_TO_SHOW', 'nothing-to-show');
define('ZBX_STYLE_NOWRAP', 'nowrap');
define('ZBX_STYLE_WORDWRAP', 'wordwrap');
define('ZBX_STYLE_WORDBREAK', 'wordbreak');
define('ZBX_STYLE_ORANGE', 'orange');
define('ZBX_STYLE_OVERLAY_CLOSE_BTN', 'overlay-close-btn');
define('ZBX_STYLE_OVERLAY_DESCR', 'overlay-descr');
define('ZBX_STYLE_OVERLAY_DESCR_URL', 'overlay-descr-url');
define('ZBX_STYLE_OVERFLOW_ELLIPSIS', 'overflow-ellipsis');
define('ZBX_STYLE_PAGING_BTN_CONTAINER', 'paging-btn-container');
define('ZBX_STYLE_PAGING_SELECTED', 'paging-selected');
define('ZBX_STYLE_PAGE_TITLE', 'page-title-general');
define('ZBX_STYLE_PAGE_TITLE_SUBMENU', 'page-title-submenu');
define('ZBX_STYLE_PROGRESS_BAR_BG', 'progress-bar-bg');
define('ZBX_STYLE_PROGRESS_BAR_CONTAINER', 'progress-bar-container');
define('ZBX_STYLE_PROGRESS_BAR_LABEL', 'progress-bar-label');
define('ZBX_STYLE_RED', 'red');
define('ZBX_STYLE_RED_BG', 'red-bg');
define('ZBX_STYLE_REL_CONTAINER', 'rel-container');
define('ZBX_STYLE_REMOVE_BTN', 'remove-btn');
define('ZBX_STYLE_RIGHT', 'right');
define('ZBX_STYLE_ROW', 'row');
define('ZBX_STYLE_INLINE_SR_ONLY', 'inline-sr-only');
define('ZBX_STYLE_VALUEMAP_LIST_TABLE', 'valuemap-list-table');
define('ZBX_STYLE_VALUEMAP_CHECKBOX', 'valuemap-checkbox');
define('ZBX_STYLE_SEARCH', 'search');
define('ZBX_STYLE_FORM_SEARCH', 'form-search');
define('ZBX_STYLE_SECOND_COLUMN_LABEL', 'second-column-label');
define('ZBX_STYLE_SELECTED', 'selected');
define('ZBX_STYLE_SELECTED_ITEM_COUNT', 'selected-item-count');
define('ZBX_STYLE_SERVER_NAME', 'server-name');
define('ZBX_STYLE_SETUP_CONTAINER', 'setup-container');
define('ZBX_STYLE_SETUP_FOOTER', 'setup-footer');
define('ZBX_STYLE_SETUP_LEFT', 'setup-left');
define('ZBX_STYLE_SETUP_LEFT_CURRENT', 'setup-left-current');
define('ZBX_STYLE_SETUP_RIGHT', 'setup-right');
define('ZBX_STYLE_SETUP_RIGHT_BODY', 'setup-right-body');
define('ZBX_STYLE_SETUP_TITLE', 'setup-title');
define('ZBX_STYLE_SIGNIN_CONTAINER', 'signin-container');
define('ZBX_STYLE_SIGNIN_LINKS', 'signin-links');
define('ZBX_STYLE_SIGNIN_LOGO', 'signin-logo');
define('ZBX_STYLE_SIGN_IN_TXT', 'sign-in-txt');
define('ZBX_STYLE_STATUS_AVERAGE_BG', 'status-average-bg');
define('ZBX_STYLE_STATUS_CONTAINER', 'status-container');
define('ZBX_STYLE_STATUS_DARK_GREY', 'status-dark-grey');
define('ZBX_STYLE_STATUS_DISABLED_BG', 'status-disabled-bg');
define('ZBX_STYLE_STATUS_DISASTER_BG', 'status-disaster-bg');
define('ZBX_STYLE_STATUS_GREEN', 'status-green');
define('ZBX_STYLE_STATUS_GREY', 'status-grey');
define('ZBX_STYLE_STATUS_HIGH_BG', 'status-high-bg');
define('ZBX_STYLE_STATUS_INFO_BG', 'status-info-bg');
define('ZBX_STYLE_STATUS_NA_BG', 'status-na-bg');
define('ZBX_STYLE_STATUS_RED', 'status-red');
define('ZBX_STYLE_STATUS_WARNING_BG', 'status-warning-bg');
define('ZBX_STYLE_STATUS_YELLOW', 'status-yellow');
define('ZBX_STYLE_SVG_GRAPH', 'svg-graph');
define('ZBX_STYLE_SVG_GRAPH_PREVIEW', 'svg-graph-preview');
define('ZBX_STYLE_SUBFILTER', 'subfilter');
define('ZBX_STYLE_SUBFILTER_ENABLED', 'subfilter-enabled');
define('ZBX_STYLE_TABLE', 'table');
define('ZBX_STYLE_TABLE_FORMS', 'table-forms');
define('CSS_STYLE_TABLE_FORMS_CONTAINER', 'table-forms-container');
define('ZBX_STYLE_TABLE_FORMS_SECOND_COLUMN', 'table-forms-second-column');
define('ZBX_STYLE_TABLE_FORMS_TD_LEFT', 'table-forms-td-left');
define('ZBX_STYLE_TABLE_FORMS_TD_RIGHT', 'table-forms-td-right');
define('ZBX_STYLE_TABLE_FORMS_OVERFLOW_BREAK', 'overflow-break');
define('ZBX_STYLE_TABLE_PAGING', 'table-paging');
define('ZBX_STYLE_TABLE_STATS', 'table-stats');
define('ZBX_STYLE_TABS_NAV', 'tabs-nav');
define('ZBX_STYLE_TAG', 'tag');
define('ZBX_STYLE_TEXTAREA_FLEXIBLE', 'textarea-flexible');
define('ZBX_STYLE_TEXTAREA_FLEXIBLE_CONTAINER', 'textarea-flexible-container');
define('ZBX_STYLE_TEXTAREA_FLEXIBLE_PARENT', 'textarea-flexible-parent');
define('ZBX_STYLE_TFOOT_BUTTONS', 'tfoot-buttons');
define('ZBX_STYLE_TD_DRAG_ICON', 'td-drag-icon');
define('ZBX_STYLE_TIME_ZONE', 'time-zone');
define('ZBX_STYLE_TIMELINE_AXIS', 'timeline-axis');
define('ZBX_STYLE_TIMELINE_DATE', 'timeline-date');
define('ZBX_STYLE_TIMELINE_DOT', 'timeline-dot');
define('ZBX_STYLE_TIMELINE_DOT_BIG', 'timeline-dot-big');
define('ZBX_STYLE_TIMELINE_TD', 'timeline-td');
define('ZBX_STYLE_TIMELINE_TH', 'timeline-th');
define('ZBX_STYLE_TOP', 'top');
define('ZBX_STYLE_TOTALS_LIST', 'totals-list');
define('ZBX_STYLE_TOTALS_LIST_HORIZONTAL', 'totals-list-horizontal');
define('ZBX_STYLE_TOTALS_LIST_VERTICAL', 'totals-list-vertical');
define('ZBX_STYLE_TOTALS_LIST_COUNT', 'count');
define('ZBX_STYLE_TREEVIEW', 'treeview');
define('ZBX_STYLE_TREEVIEW_PLUS', 'treeview-plus');
define('ZBX_STYLE_UPPERCASE', 'uppercase');
define('ZBX_STYLE_WARNING_BG', 'warning-bg');
define('ZBX_STYLE_WIDGET_URL', 'widget-url');
define('ZBX_STYLE_BLINK_HIDDEN', 'blink-hidden');
define('ZBX_STYLE_YELLOW', 'yellow');
define('ZBX_STYLE_YELLOW_BG', 'yellow-bg');
define('ZBX_STYLE_FIELD_LABEL_ASTERISK', 'form-label-asterisk');
define('ZBX_STYLE_PROBLEM_ICON_LIST' , 'problem-icon-list');
define('ZBX_STYLE_PROBLEM_ICON_LIST_ITEM' , 'problem-icon-list-item');
define('ZBX_STYLE_ZABBIX_LOGO', 'zabbix-logo');
define('ZBX_STYLE_ZABBIX_SIDEBAR_LOGO', 'zabbix-sidebar-logo');
define('ZBX_STYLE_ZABBIX_SIDEBAR_LOGO_COMPACT', 'zabbix-sidebar-logo-compact');




// input fields
define('ZBX_TEXTAREA_HTTP_PAIR_NAME_WIDTH',		218);
define('ZBX_TEXTAREA_HTTP_PAIR_VALUE_WIDTH',	218);
define('ZBX_TEXTAREA_MACRO_WIDTH',				250);
define('ZBX_TEXTAREA_MACRO_VALUE_WIDTH',		300);
define('ZBX_TEXTAREA_MACRO_INHERITED_WIDTH',	180);
define('ZBX_TEXTAREA_TAG_WIDTH',				250);
define('ZBX_TEXTAREA_TAG_VALUE_WIDTH',			300);
define('ZBX_TEXTAREA_MAPPING_VALUE_WIDTH',		250);
define('ZBX_TEXTAREA_MAPPING_NEWVALUE_WIDTH',	250);
define('ZBX_TEXTAREA_COLOR_WIDTH',				96);
define('ZBX_TEXTAREA_FILTER_SMALL_WIDTH',		150);
define('ZBX_TEXTAREA_FILTER_STANDARD_WIDTH',	300);
define('ZBX_TEXTAREA_TINY_WIDTH',				75);
define('ZBX_TEXTAREA_SMALL_WIDTH',				150);
define('ZBX_TEXTAREA_MEDIUM_WIDTH',				270);
define('ZBX_TEXTAREA_STANDARD_WIDTH',			453);
define('ZBX_TEXTAREA_BIG_WIDTH',				540);
define('ZBX_TEXTAREA_NUMERIC_STANDARD_WIDTH',	75);
define('ZBX_TEXTAREA_NUMERIC_BIG_WIDTH',		150);
define('ZBX_TEXTAREA_2DIGITS_WIDTH',			35);	// please use for date selector only
define('ZBX_TEXTAREA_4DIGITS_WIDTH',			50);	// please use for date selector only
define('ZBX_TEXTAREA_INTERFACE_IP_WIDTH',		225);
define('ZBX_TEXTAREA_INTERFACE_DNS_WIDTH',		175);
define('ZBX_TEXTAREA_INTERFACE_PORT_WIDTH',		100);
define('ZBX_TEXTAREA_STANDARD_ROWS',			7);

