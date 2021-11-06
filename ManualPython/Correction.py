import mysql.connector
import timeit
import pandas.io.sql as sql
import pandas as pd
from openpyxl import load_workbook

# Konfigurasi Database
def connector():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="jatim_cbt"
    )
    return mydb

#Dapatkan Jawaban Ujian
def getjawaban(mycursor, id_ujian):
    mycursor.execute("SELECT id_mapel, list_jawab FROM ujian WHERE id_ujian =" + str(id_ujian))
    #mycursor.execute("SELECT nama_siswa, nisn, nama_mapel, nilai, jml_benar, id_mapel, list_jawab FROM nilaisiswa WHERE id_ujian =" + str(id_ujian))
    myresult = mycursor.fetchall()
    return myresult

def getSoalById(mycursor ,no_soal, id_mapel):
    mycursor.execute("SELECT jawaban FROM soal WHERE no_soal = " + str(no_soal) + " AND id_mapel = " + str(id_mapel))
    myresult = mycursor.fetchall()
    return myresult

def updateNilai(id_ujian, jumlah_benar, nilai):
    mydb = connector()
    mycursor = mydb.cursor()
    sql = "UPDATE ujian SET jml_benar = %s, nilai = %s WHERE id_ujian = %s"
    val = (str(jumlah_benar), str(nilai), str(id_ujian))
    mycursor.execute(sql, val)
    mydb.commit()

def excel(total_ujian):
    mydb = connector()
    df=sql.read_sql('SELECT id_ujian AS Id_Ujian, nama_siswa as Nama_Siswa, nisn as NISN, nama_mapel as Mata_Pelajaran, nilai as Nilai, jml_benar as Jumlah_Benar FROM nilaisiswa WHERE id_ujian <' + str(total_ujian) ,mydb)
    df.to_excel('koreksi.xlsx', index=False)
    #df.to_csv('koreksi4.csv')

def updateExcel(df):
    excel = pd.read_excel('rekapnilai.xlsx')
    result = pd.concat([excel, df], ignore_index=True)
    result.to_excel('rekapnilai.xlsx', index=False)

def main():
    start = timeit.default_timer()  #Hitung Komputasi
    #Koneksi Database
    mydb = connector()
    mycursor = mydb.cursor()
    #total_ujian = 3500001
    total_ujian = 1001
    total = total_ujian
    for ujian in range(total_ujian):
        total_ujian += 1
        myresult = getjawaban(mycursor, ujian)
        for (id_mapel, list_jawab) in myresult:
            pc_jawaban = list_jawab.split(",")
            jumlah_benar     = 0
            jumlah_salah     = 0
            jumlah_soal    = len(pc_jawaban) - 1;
            pc_jawaban.pop(31) #Bersihkan dataset
            for jwb in pc_jawaban:
                pc_dt = jwb.split(":")
                no_soal     = pc_dt[0]
                jawabuser   = pc_dt[1]
                cek_jwb = getSoalById(mycursor ,no_soal, id_mapel)
                for (jawaban) in cek_jwb:
                    if jawabuser == jawaban[0]: jumlah_benar+=1
                    else: jumlah_salah+=1 
            nilai = (jumlah_benar / jumlah_soal) * 100
            updateNilai(ujian, jumlah_benar, nilai)
            #Kalau pengen dicetak, tapi matiin ae biar cepet
            #print("Koreksi soal no-{}, benar={}, nilai={:.2f}".format(ujian, jumlah_benar, nilai))
    excel(total)
    stop = timeit.default_timer()
    print('Waktu Selesai: {} detik'.format(stop - start))  
    # excel(total)


if __name__ == "__main__":
    main()

#Buat Reset DB UPDATE ujian SET nilai = 0, jml_benar = 0 WHERE id_ujian <= 10001;