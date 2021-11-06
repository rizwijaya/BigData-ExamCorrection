#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created with Spyder on Wed Oct 13 15:49:55 2021

@author: Rizqi Wijaya
"""

import mysql.connector
import pandas as pd
import timeit
import psutil
from concurrent.futures import ProcessPoolExecutor
import os

# Konfigurasi Database
def connector():
    # mydb = mysql.connector.connect(
    #     host="103.147.154.84",
    #     user="ludaring_klaster",
    #     password="Klaster123",
    #     database="ludaring_jatim_cbt"
    # )
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="jatim_cbt"
    )
    return mydb
    
def sikronDB(id_mapel, id_asal):
    print(f"Sikronisasi {os.getpid()} Kode mapel {id_mapel} ...")
    startSikron = timeit.default_timer()  #Hitung Sikronisasi
    try:
        mydb = connector()
        query = 'SELECT id_ujian, nama_siswa, nisn, id_mapel, nama_mapel, list_jawab, jml_benar, nilai, nama_asal FROM nilaisiswa WHERE id_asal ='+str(id_asal)+' AND id_mapel ='+str(id_mapel)+' LIMIT 1;'
        ujiansiswa = pd.read_sql(query, mydb) 
        query2 = 'SELECT id_mapel, no_soal, jawaban FROM soal;'
        kuncijawaban = pd.read_sql(query2, mydb)
    except:
        print("Error: Data tidak dapat dikonversi")
    mydb.close()
    stopSikron = timeit.default_timer()
    print("Sikronisasi kode mapel {} selesai, {} detik. Koreksi ...".format(id_mapel, stopSikron - startSikron))

    time = koreksi(ujiansiswa, kuncijawaban)
    print('Kecepatan koreksi mapel {} : {} detik'.format(ujiansiswa.iloc[0]['nama_mapel'], time))
    return time

def koreksi(ujiansiswa, kuncijawaban):
    startKomputasi = timeit.default_timer() #Hitung Komputasi
    #ujiansiswa.query("id_mapel == " + str(id_map))    
    #Loop jawaban peserta
    for i, row in ujiansiswa.iterrows():
        pc_jawaban       = ujiansiswa.loc[i, "list_jawab"].split(",")
        jumlah_benar     = 0
        #jumlah_soal    = len(pc_jawaban) - 1
        pc_jawaban.pop(31) #Bersihkan dataset
        for jwb in pc_jawaban:
            pc_dt = jwb.split(":")
            no_soal     = pc_dt[0]
            jawabuser   = pc_dt[1]
            cek_jwb = kuncijawaban.query("no_soal == " + str(no_soal) +" and id_mapel == " + str(ujiansiswa.loc[i, "id_mapel"])) #Dapatkan kunci jawaban soal
            cek_jwb = cek_jwb["jawaban"].to_string(index=False)
            if jawabuser == cek_jwb: jumlah_benar+=1
            nilai = jumlah_benar * 2.5  
    
        stopKomputasi = timeit.default_timer()
        ujiansiswa.at[i,'jml_benar']= str(jumlah_benar)
        ujiansiswa.at[i,'nilai']= str(nilai)
 
    mapel = ujiansiswa.iloc[0]['nama_mapel']
    print("Simpan Nilai %s ke Excel ..." %mapel)
    del ujiansiswa["id_mapel"]
    del ujiansiswa["list_jawab"]
    ujiansiswa.index += 1
    #startSimpan = timeit.default_timer() 
    nama =  "Nilai_" +ujiansiswa.iloc[0]['nama_asal'] + "_" + mapel + ".xlsx"
    ujiansiswa.to_excel(nama, sheet_name="nilai")
    
    #stopSimpan = timeit.default_timer()
    #print('Tersimpan ' + nama + ',waktu: {} detik\n'.format(stopSimpan - startSimpan))
    return stopKomputasi - startKomputasi

def main():
    time = 0
    kodeAsal = 12 #Setting kode asal sesuai kotanya
    start = timeit.default_timer()  #Hitung Sikronisasi
    with ProcessPoolExecutor(max_workers=psutil.cpu_count()) as exec:
        for id_mapel in range(1, 8):
            globals()[f"time_{id_mapel}"] = exec.submit(sikronDB, id_mapel, kodeAsal)
    stop = timeit.default_timer()  #Hitung Sikronisasi
    
    for id_mapel in range(1, 8):
        time += float(globals()[f"time_{id_mapel}"].result())
    print("Rata-rata Waktu Koreksi {} detik".format(time/7))
    print('Total Proses Komputasi: {} detik'.format(stop - start))

if __name__ == '__main__': 
    main()