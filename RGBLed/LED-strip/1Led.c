#include <stdio.h>
#include <wiringPi.h>
#include <time.h>

void AllesAan(void);
void AllesUit(void);
void AllesRood(void);
void AllesBlauw(void);
void AllesGroen(void);
void RGBKleur(int r, int g , int b);
void ColorKnipper(void);
void KnipperLicht(void);
void KnipperLed(void);
void Schakelaar(void);


int main(int argc, char *argv[])
{
	wiringPiSetupGpio();

	pinMode(17,INPUT); //schakelaar
	pinMode(18,INPUT); //drukknop
	pinMode(4,OUTPUT); //ledje
	pinMode(22, OUTPUT); //clock
	pinMode(23, OUTPUT); //data
	

    printf( "argc = %d\n", argc );
    for( int i = 0; i < argc; ++i ) {
        printf( "argv[ %d ] = %s\n", i, argv[ i ] );
    }




	char function[30];
	strcpy(function, argv[1]);
	if (!strncmp(function, "AllesAan", 15)) {
		AllesAan();
	}
	if (!strncmp(function, "AllesUit", 15)) {
		AllesUit();
	}
	if (!strncmp(function, "AllesRood", 15)) {
		AllesRood();
	}
	if (!strncmp(function, "AllesBlauw", 15)) {
		AllesBlauw();
	}
	if (!strncmp(function, "AllesGroen", 15)) {
		AllesGroen();
	}
	if (!strncmp(function, "ColorKnipper", 15)) {
		ColorKnipper();
	}
	if (!strncmp(function, "KnipperLicht", 15)) {
		KnipperLicht();
	}
	if (!strncmp(function, "KnipperLed", 15)) {
		KnipperLed();
	}
	if (!strncmp(function, "Schakelaar", 15)) {
		Schakelaar();
	}
	if (!strncmp(function, "RGB", 15)) {
		RGBKleur(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}




	
	
	return 0;
}

void AllesAan(void){
	for (int x = 0; x<9; x++){
		for (int y = 0; y<8; y++){
			digitalWrite(22, 0);
			digitalWrite(23, 1);
			digitalWrite(22, 1);
		}
		for (int z = 0; z<8; z++){
			digitalWrite(22, 0);
			digitalWrite(23, 1);
			digitalWrite(22, 1);
		}
		for (int a = 0; a<8; a++){
			digitalWrite(22, 0);
			digitalWrite(23, 1);
			digitalWrite(22, 1);
		}
	}
}

void AllesUit(void){

	for (int x = 0; x<9; x++){
		for (int y = 0; y<8; y++){
			digitalWrite(22, 0);
			digitalWrite(23, 0);
			digitalWrite(22, 1);
		}
		for (int z = 0; z<8; z++){
			digitalWrite(22, 0);
			digitalWrite(23, 0);
			digitalWrite(22, 1);
		}
		for (int a = 0; a<8; a++){
			digitalWrite(22, 0);
			digitalWrite(23, 0);
			digitalWrite(22, 1);
		}
	}

}

void AllesRood(void){

	for (int x =0; x<9;x++){
		for (int y=0; y<8;y++){
		digitalWrite(22, 0);
		digitalWrite(23, 1);
		digitalWrite(22, 1);
		}
		for (int z=0; z<8;z++){
		digitalWrite(22, 0);
		digitalWrite(23, 0);
		digitalWrite(22, 1);
		}
		for (int a=0; a<8;a++){
		digitalWrite(22, 0);
		digitalWrite(23,0);
		digitalWrite(22, 1);
		}
	}

}

void AllesBlauw(void){
	for (int x = 0; x<9; x++){
		for (int y = 0; y<8; y++){
			digitalWrite(22, 0);
			digitalWrite(23, 0);
			digitalWrite(22, 1);
		}
		for (int z = 0; z<8; z++){
			digitalWrite(22, 0);
			digitalWrite(23, 0);
			digitalWrite(22, 1);
		}
		for (int a = 0; a<8; a++){
			digitalWrite(22, 0);
			digitalWrite(23, 1);
			digitalWrite(22, 1);
		}
	}
}

void AllesGroen(void){
	for (int x = 0; x<9; x++){
		for (int y = 0; y<8; y++){
			digitalWrite(22, 0);
			digitalWrite(23, 0);
			digitalWrite(22, 1);
		}
		for (int z = 0; z<8; z++){
			digitalWrite(22, 0);
			digitalWrite(23, 1);
			digitalWrite(22, 1);
		}
		for (int a = 0; a<8; a++){
			digitalWrite(22, 0);
			digitalWrite(23, 0);
			digitalWrite(22, 1);
		}
	}
}

void RGBKleur(int re, int ge, int be){
	char bitwaarde = 128;
	char r = (char)re;
	char b = (char)be;
	char g = (char)ge;
	for (int x = 0; x<9; x++){
		for (int y = 0; y<8; y++){
			if ((r & (bitwaarde)) == bitwaarde) {
				digitalWrite(22, 0);
				digitalWrite(23, 1);
				digitalWrite(22, 1);
			}
			else {
				digitalWrite(22, 0);
				digitalWrite(23, 0);
				digitalWrite(22, 1);
			}

			bitwaarde = bitwaarde / 2;
		}

		bitwaarde = 128;

		for (int z = 0; z<8; z++){
			if ((g & (bitwaarde)) == bitwaarde) {
				digitalWrite(22, 0);
				digitalWrite(23, 1);
				digitalWrite(22, 1);
			}
			else {
				digitalWrite(22, 0);
				digitalWrite(23, 0);
				digitalWrite(22, 1);
			}
			bitwaarde = bitwaarde / 2;
		}

		bitwaarde = 128;

		for (int a = 0; a<8; a++){
			if ((b & (bitwaarde)) == bitwaarde) {
				digitalWrite(22, 0);
				digitalWrite(23, 1);
				digitalWrite(22, 1);
			}
			else {
				digitalWrite(22, 0);
				digitalWrite(23, 0);
				digitalWrite(22, 1);
			}
			bitwaarde = bitwaarde / 2;
		}
		bitwaarde =128;
	}
}

void ColorKnipper(){
AllesRood();
delay(1000);
AllesBlauw();
delay(1000);
AllesGroen();
delay(1000);
AllesRood();
delay(1000);
AllesBlauw();
delay(1000);
AllesGroen();
delay(1000);
}


void KnipperLicht(){
for (int del = 0 ; del < 10; del++){
AllesAan();
delay(200);
AllesUit();
delay(200);
}
}


void KnipperLed(){
while (1==1){
	 digitalWrite(4, 1);
	delay(250);
    	digitalWrite(4, 0);





}



}

void Schakelaar(void){
while(1==1){
	if (digitalRead(17)){
		AllesAan();
	}else{
		
		AllesUit();
		
	}
}

}


