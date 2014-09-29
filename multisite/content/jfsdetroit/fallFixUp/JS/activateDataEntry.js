$('#entryForm').widgets_apps_simple_data_entry(
{

saveButtonSelector:".saveData",
parameterFolderName:"_PARAMETERS",
parameterFileName:'simpleData.ini'

}
);


if (location.host.match('local')){
var init={
	'firstName':'TQ',
	'lastName':'White',
	'address':'5004 Three Points Blvd',
	'city':'Mound',
	'state':'MN',
	'zip':'55364',
	'windowWashingCount':'2',
	'winterizingWindowsCount':'3',
	'winterizingWindowsInformation':'wintery windows',
	'winterizingDoorsCount':'4',
	'winterizingDoorsInfo':'open those wintery doors',
	'clientInfo':'crotchety old man',
	'socialWorker':'Emily White',
}

	for (var i in init){
		var element=init[i];

		$("[name='"+i+"']").val(element);
	}


}