function deleteRecord(tableName, recId) {
    window.location = '../controllers/c-delete-record.php?'+'tableName='+tableName+'&recordId='+recId;
}