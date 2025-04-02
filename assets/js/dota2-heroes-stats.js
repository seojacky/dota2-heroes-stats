/**
 * Dota 2 Heroes Stats JavaScript
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Initialize sorting for the heroes table
        if ($('.dhs-heroes-table').length) {
            initTableSorting();
            initTableSearchFilter();
        }
    });
    
    /**
     * Initialize table sorting functionality
     */
    function initTableSorting() {
        const $table = $('.dhs-heroes-table');
        const $headers = $table.find('thead th');
        
        // Add sort icons and cursor style
        $headers.append('<span class="dhs-sort-icon"></span>');
        $headers.css('cursor', 'pointer');
        
        // Handle click on table headers
        $headers.on('click', function() {
            const $header = $(this);
            const columnIndex = $header.index();
            const isAscending = $header.hasClass('dhs-sort-asc');
            
            // Remove sorting classes from all headers
            $headers.removeClass('dhs-sort-asc dhs-sort-desc');
            
            // Add appropriate sorting class
            if (isAscending) {
                $header.addClass('dhs-sort-desc');
            } else {
                $header.addClass('dhs-sort-asc');
            }
            
            // Sort the table
            sortTable($table, columnIndex, !isAscending);
        });
    }
    
    /**
     * Sort table rows based on column index and direction
     */
    function sortTable($table, columnIndex, isAscending) {
        const $tbody = $table.find('tbody');
        const rows = $tbody.find('tr').get();
        
        // Sort rows
        rows.sort(function(a, b) {
            const aValue = getCellValue(a, columnIndex);
            const bValue = getCellValue(b, columnIndex);
            
            // Check if values are numeric
            const aNumeric = !isNaN(parseFloat(aValue));
            const bNumeric = !isNaN(parseFloat(bValue));
            
            if (aNumeric && bNumeric) {
                return isAscending ? parseFloat(aValue) - parseFloat(bValue) : parseFloat(bValue) - parseFloat(aValue);
            } else {
                return isAscending ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            }
        });
        
        // Reinsert sorted rows
        $.each(rows, function(index, row) {
            $tbody.append(row);
        });
    }
    
    /**
     * Get cell value for sorting
     */
    function getCellValue(row, columnIndex) {
        const $cell = $(row).find('td').eq(columnIndex);
        
        // Handle hero name column (index 0) differently
        if (columnIndex === 0) {
            // Extract the hero name without the ID and image
            return $cell.text().trim().split('. ')[1];
        }
        
        return $cell.text().trim();
    }
    
    /**
     * Initialize search filter
     */
    function initTableSearchFilter() {
        // Create search input
        const $searchContainer = $('<div class="dhs-search-container"></div>');
        const $searchInput = $('<input type="text" class="dhs-search-input" placeholder="Search heroes...">');
        
        $searchContainer.append($searchInput);
        $('.dhs-container h2').after($searchContainer);
        
        // Add search functionality
        $searchInput.on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();
            $('.dhs-heroes-table tbody tr').each(function() {
                const heroName = $(this).find('td').eq(0).text().toLowerCase();
                if (heroName.indexOf(searchValue) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Style the search input
        $searchContainer.css({
            'margin-bottom': '15px',
            'display': 'flex',
            'justify-content': 'flex-end'
        });
        
        $searchInput.css({
            'padding': '8px 12px',
            'border': '1px solid #e2e8f0',
            'border-radius': '4px',
            'width': '250px',
            'font-size': '14px'
        });
    }
    
})(jQuery);
