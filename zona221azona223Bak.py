fname = 'clorinda.txt'
# if len(fname) < 1 : fname = "words.txt"
fh= open(fname)
counter = 0
revendmapas=dict()
for listrevend in fh:
    revends = listrevend.rstrip().split()
    for revend in revends:
        revendmapas[revend] = counter
        counter += 1
fh.close

for k,v in revendmapas.items():
	# print ("Clave:",k,"Valor:",v)
    qrevend= k.split(";")
    qrevend=qrevend[0]
      
  #   print(qrevend)
# for k,v in dicMapas.items():
#	print ("Clave:",k,"Valor:",v)

fnameBus = 'qzobuscar.txt'
fbus= open(fnameBus)
counter = 0
dicBus = dict()
for lineB in fbus:
    wordsB = lineB.rstrip().split()
    for wordB in wordsB:
        dicBus[wordB] = counter
        counter += 1
fbus.close()


## Bloque principal del programa
for mirev,z in revendmapas.items():
     
    qrevend= mirev.split(";")
    buscorev=qrevend[0]
    for k,v in dicBus.items():
	    # print ("Clave:",k,"Valor:",v)
        zonas= k.split(";")
        qbusco=zonas[0]
        qreemplazo=zonas[1]

        print(qrevend)
        print(qbusco)
        print(qreemplazo)
        print()
        for line in fileinput.input(archivoreemplazo,inplace=True): 
            sec=line[3:6]
            if buscorev in line :
                # print ('Encontre la REvendedora!!!!')
                if qbusco+sec in line:
                    # print('Encontre la Zona!')
                    print(line.replace(qbusco+sec,qreemplazo+sec))
        
    # print(qbusco,qreemplazo )
      


with fileinput.FileInput(archivoreemplazo,inplace = True, backup ='.bak') as f:
    for line in f:
        sec=line[3:6]
        zonasec=buscotexto+sec
        zonasecreemp=reemplazotext+sec
        if revend in line:
            print(line.replace(zonasec,zonasecreemp),end='')
        else:
            print(line, end='')
