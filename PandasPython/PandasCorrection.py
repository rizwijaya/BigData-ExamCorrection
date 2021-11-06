#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created with Spyder on Wed Oct 13 15:49:55 2021

@author: Rizqi Wijaya
"""

import mysql.connector
import modin.pandas as pd
import timeit
#from distributed import Client
# Konfigurasi Database
def connector():
    mydb = mysql.connector.connect(
        host="localhost",
        #port=3306,
        user="root",
        password="",
        database="jatim_cbt"
    )
    return mydb

def sikronDB(id_asal):
    try:
        mydb = connector()
        print("Sikronisasi data siswa ...")
        query = 'SELECT id_ujian, nama_siswa, nisn, id_mapel, nama_mapel, list_jawab, jml_benar, nilai, nama_asal FROM nilaisiswa WHERE id_asal =%d LIMIT 10;'%id_asal
        ujiansiswa = pd.read_sql(query, mydb)
        print("Sikronisasi kunci jawaban ...") 
        query2 = 'SELECT id_mapel, no_soal, jawaban FROM soal;'
        kuncijawaban = pd.read_sql(query2, mydb) 
        print("Sikronisasi selesai")
    except:
        print("Error: unable to convert the data")
    mydb.close()
    return ujiansiswa, kuncijawaban

def koreksi(kodeAsal):
    startSikron = timeit.default_timer()  #Hitung Sikronisasi
    ujiansiswa, kuncijawaban = sikronDB(kodeAsal)
    stopSikron = timeit.default_timer()
    startKomputasi = timeit.default_timer()  #Hitung Komputasi
    #Loop jawaban peserta
    for i in range(len(ujiansiswa)) : #Exclude misal 6 brarti loop 5 //dari nol
        pc_jawaban       = ujiansiswa.loc[i, "list_jawab"].split(",")
        jumlah_benar     = 0
        jumlah_salah     = 0
        jumlah_soal    = len(pc_jawaban) - 1
        pc_jawaban.pop(31) #Bersihkan dataset
        for jwb in pc_jawaban:
            pc_dt = jwb.split(":")
            no_soal     = pc_dt[0]
            jawabuser   = pc_dt[1]
            cek_jwb = kuncijawaban.query("no_soal == " + str(no_soal) +" and id_mapel == " + str(ujiansiswa.loc[i, "id_mapel"])) #Dapatkan kunci jawaban soal
            cek_jwb = cek_jwb["jawaban"].to_string(index=False)
            if jawabuser == cek_jwb: jumlah_benar+=1
            else: jumlah_salah+=1 
            nilai = (jumlah_benar / jumlah_soal) * 100
        ujiansiswa.at[i,'jml_benar']= str(jumlah_benar)
        ujiansiswa.at[i,'nilai']= str(nilai)   
        
    del ujiansiswa["id_mapel"]
    del ujiansiswa["list_jawab"]
    ujiansiswa.index += 1
    ujiansiswa.to_excel("NilaiSiswa_%s.xlsx"%ujiansiswa.iloc[0]['nama_asal'],
                        sheet_name="nilai")
    
    stopKomputasi = timeit.default_timer()
    return stopSikron - startSikron, stopKomputasi - startKomputasi, stopKomputasi - startSikron     
def main():
    #client = Client()
    kodeAsal = 5 #Setting kode asal sesuai kotanya
    sikron, komputasi, total = koreksi(kodeAsal)
    #Cetak waktu komputasi dari sikron hingga total
    print('Waktu Sikronisasi: {} detik'.format(sikron))
    print('Waktu Komputasi: {} detik'.format(komputasi))
    print('Waktu Total: {} detik'.format(total))

if __name__ == '__main__': 
    main()