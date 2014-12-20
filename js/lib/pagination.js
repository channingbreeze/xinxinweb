define(function(require, exports) {
	require("jquery");
	function Pagination() {}
	Pagination.prototype.prasePaginationItem = function(page, pageText) {
		if(!pageText) {
			pageText = page;
		}
		return ('<li><a href="#" data-to="' + page + '">' + pageText + '</a></li>');
	}
	Pagination.prototype.reader = function(options) {
		var totalPage = options.totalPage;
		//当前页码
		var currentPage = options.toPage;
		//上一页
		var prevPage = currentPage - 1;
		//下一页
		var nextPage = currentPage + 1;
		//开始页面
		var fromPage = 0;
		//结束页面
		var toPage = 0;
		
		var tpl = [];
		tpl.push('<ul class="pagination">');

		if (currentPage <= 1)
			tpl.push('<li><span>«</span></li>');
		else
			tpl.push(this.prasePaginationItem(1, "«"));
		if (prevPage < 1)
			tpl.push('<li><span>‹</span></li>');
		else
			tpl.push(this.prasePaginationItem(prevPage, "‹"));

		//当前页面大于5时，显示省略号和第一页
		if (currentPage > 5) {
			tpl.push(this.prasePaginationItem(1));
			tpl.push('<li><span>...</span></li>');
			//当前页码大于总页数-3的时候，开始页码为总页数-4
			//否则开始页码为当前页面-2；
			if (currentPage >= totalPage - 3)
				fromPage = totalPage - 4;
			else
				fromPage = currentPage - 2;
		} else
			fromPage = 1;

		//当前页码前面一个页码
		toPage = currentPage - 1;
		//输出当前页码前的页码
		if (fromPage > 0 && fromPage <= toPage) {
			for ( var i = fromPage; i <= toPage; i++) {
				tpl.push(this.prasePaginationItem(i));
			}
		}

		tpl.push('<li><span>' + currentPage + '</span></li>');

		//当前页码大于5的时候，显示当前页面的后2个页码
		if (currentPage > 5) {
			if (currentPage >= totalPage - 3) {
				if (totalPage > currentPage)
					fromPage = currentPage + 1;
				else
					fromPage = totalPage;

				toPage = totalPage;
			} else {
				fromPage = currentPage + 1;
				toPage = currentPage + 2;
			}
		} else {
			fromPage = currentPage + 1;
			if (totalPage > 8)
				toPage = 6;
			else
				toPage = totalPage;
		}
		//显示当前页码前2页，
		if (totalPage > 5 && (totalPage - 3) > currentPage || fromPage == 2
				&& totalPage == 5) {
			for ( var j = fromPage; j <= toPage; j++) {
				tpl.push(this.prasePaginationItem(j));
			}
		}
		//判断树否需要显示最后一页页码
		if (totalPage > 8 && (totalPage - 3) > currentPage
				&& totalPage !== currentPage) {
			tpl.push("<li><span>...</span></li>");
			tpl.push(this.prasePaginationItem(totalPage))
		} else if (totalPage > currentPage && (totalPage - currentPage) < 4) {
			//当前页面大于总页码减去5时，显示最后5页
			for ( var k = fromPage; k <= toPage; k++) {
				tpl.push(this.prasePaginationItem(k));
			}
		}

		if (currentPage >= totalPage)
			tpl.push('<li><span>›</span></li>');
		else
			tpl.push(this.prasePaginationItem(nextPage, "›"));

		if (currentPage >= totalPage)
			tpl.push('<li><span>»</span></li>');
		else
			tpl.push(this.prasePaginationItem(totalPage, "»"));
		tpl.push('</ul>');
		return tpl.join("");
	}
	$.extend({
		pagination : function(options) {
			var page = new Pagination();
			return page.reader(options);
		}
	})
});