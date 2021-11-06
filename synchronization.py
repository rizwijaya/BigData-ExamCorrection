import pandas as pd
import mysql.connector
import os
import glob
import timeit
import psutil
from concurrent.futures import ProcessPoolExecutor

# Connect to SQL Server
def connector():
    mydb = mysql.connector.connect(
        host="103.147.154.84",
        user="ludaring_klaster",
        password="Klaster123",
        database="ludaring_jatim_cbt"
    )
	# mydb = mysql.connector.connect(
    #     host="localhost",
    #     user="root",
    #     password="",
    #     database="jatim_cbt"
    # )
    return mydb

def importSql(file):
	print(f"Import {os.getpid()} file {file} ke Sql")
	mydb = connector()
	cursor = mydb.cursor()
	
	# Import Excel to Dataframe
	data = pd.read_excel(str(file))     
	df = pd.DataFrame(data, columns = ['id_ujian', 'jml_benar', 'nilai'])

	# Insert DataFrame to Table
	for row in df.itertuples():
		cursor.execute('''
					UPDATE ujian SET jml_benar = %s, nilai = %s WHERE id_ujian = %s
					''',
					(row.jml_benar,
					row.nilai,
					row.id_ujian)
					)
	mydb.commit()
	
def main():
	start = timeit.default_timer()
	os.listdir(".")
	with ProcessPoolExecutor(max_workers=psutil.cpu_count()) as exec:
		for file in glob.glob("*.xlsx"):
			exec.submit(importSql, file)
	stop = timeit.default_timer()
	print('Berhasil Import semua Excel ke Sql Server, {} detik'.format(stop - start))
	
if __name__ == '__main__': 
    main()