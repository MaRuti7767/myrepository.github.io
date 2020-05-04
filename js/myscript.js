		
		$("#grid").kendoGrid({

			dataSource:{
				type:"odata-v4",
				transport:{
					read:"https://services.odata.org/V4/Northwind/Northwind.svc/Orders"
				},
				pageSize:10,
				serverPaging:true,
				serverFiltering:true
			},
			pageable:true

		});