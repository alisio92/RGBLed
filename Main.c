#include <stdbool.h>
#include <stdio.h>
#include <share.h>
#include <signal.h>
#include <string.h>
#include <stdlib.h>
#include <stdarg.h>  
#include <windows.h>

#include <time.h>
#include <wiringPi.h>

int randomG(int min, int max);
int random();
int stop();
int start();
int on_alarm();
char* concat(int count, ...);
int setLed0(int r, int g, int b);
int setLed1(int r, int g, int b);
int setLed2(int r, int g, int b);
int setLed3(int r, int g, int b);
int setLed4(int r, int g, int b);
int setLed5(int r, int g, int b);
int setLed6(int r, int g, int b);
int setLed7(int r, int g, int b);
int setLoopled(int id);

void AllesUit();
void AllesAan();
void AllesGroen();
void AllesRood();
void AllesBlauw();
void RGBKleur(char r, char g, char b);
void VeranderLed(char led, char r, char g, char b);
void BlinkLed();


int ledR[9];
int ledG[9];
int ledB[9];
bool stopRunning = false;
int loopled = 7;

int randomG(int min, int max) {
	return rand() % max + min;
}

int on_alarm()
{
	/*while (!stopRunning)
	{
	random();
	Sleep(1);
	}*/
	for (int i = 0; i < 60; i++){
		random();
		Sleep(1);
	}
	return -1;
}

int random(){
	FILE *stream;
	if ((stream = _fsopen("outfile.txt", "wt", _SH_DENYWR)) != NULL)
	{
		for (int i = 0; i < 9; i++){
			int r = randomG(-1, 255);
			int g = randomG(-1, 255);
			int b = randomG(-1, 255);
			ledR[i] = r;
			ledG[i] = g;
			ledB[i] = b;

			//fprintf(stream, concat(7, i, ":", r, ":", g, ":", b));
			char chars[30] = "";
			chars[0] = i;
			chars[1] = ":";
			chars[2] = r;
			chars[3] = ":";
			chars[4] = g;
			chars[5] = ":";
			chars[6] = b;
			//fprintf(stream, concat(3, (char)10, ":", (char)20));
			fprintf(stream, "a:b");
			//fprintf(stream, concat(7, chars[0], chars[1], chars[2], chars[3], chars[4], chars[5], chars[6]));
		}
		fclose(stream);
	}
	system("type outfile.txt");
	return -1;
}

char* concat(int count, ...)
{
	va_list ap;
	int i;

	// Find required length to store merged string
	int len = 1; // room for NULL
	va_start(ap, count);
	for (i = 0; i < count; i++)
		len += strlen(va_arg(ap, char*));
	va_end(ap);

	// Allocate memory to concat strings
	char *merged = calloc(sizeof(char), len);
	int null_pos = 0;

	// Actually concatenate strings
	va_start(ap, count);
	for (i = 0; i < count; i++)
	{
		char *s = va_arg(ap, char*);
		strcpy(merged + null_pos, s);
		null_pos += strlen(s);
	}
	va_end(ap);

	return merged;
}

int stop(){
	stopRunning = true;
	return -1;
}

int start(){
	stopRunning = false;
	return -1;
}

int setLoopled(int id, int dir){
	if (id == 0) ;
	if (id == 1) ;
	if (id == 2) ;
	if (id == 3) ;
	if (id == 4) ;
	if (id == 5) ;
	if (id == 6) ;
	if (id == 7) ;
	Sleep(1);
	if (dir = 0){
		if (id <= loopled) setLoopled(id++, dir);
		else setLoopled(0, 2);
	}
	else if (dir = 1) {
		if (id > 0) setLoopled(loopled, 2);
		else setLoopled(id--, dir);
	}
	return 2;
}

int setoptelled(){
	return 1;
}

int main(int argc, char *argv[]) {

	wiringPiSetupGpio();

	pinMode(17, INPUT); //schakelaar
	pinMode(18, INPUT); //drukknop
	pinMode(4, OUTPUT); //ledje
	pinMode(22, OUTPUT); //clock
	pinMode(23, OUTPUT); //data

	srand(time(NULL));
	char function[30];
	strcpy(function, argv[1]);
	if (!strncmp(function, "randomG", 10))
	{
		return randomG(atoi(argv[2]), atoi(argv[3]));
	}
	if (!strncmp(function, "random", 10)) {
		return on_alarm();
	}
	if (!strncmp(function, "stop", 10)) {
		return stop();
	}
	if (!strncmp(function, "start", 10)) {
		return start();
	}
	if (!strncmp(function, "setLoopled", 10)) {
		int start = 0;
		if (atoi(argv[2] == 1)) start = 1;
		return setLoopled(start, atoi(argv[2]));
	}
	if (!strncmp(function, "setoptelled", 10)) {
		return setoptelled();
	}
	if (!strncmp(function, "setLed0", 10)) {
		return setLed0(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	if (!strncmp(function, "setLed1", 10)) {
		return setLed1(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	if (!strncmp(function, "setLed2", 10)) {
		return setLed2(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	if (!strncmp(function, "setLed3", 10)) {
		return setLed3(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	if (!strncmp(function, "setLed4", 10)) {
		return setLed4(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	if (!strncmp(function, "setLed5", 10)) {
		return setLed5(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	if (!strncmp(function, "setLed6", 10)) {
		return setLed6(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	if (!strncmp(function, "setLed7", 10)) {
		return setLed7(atoi(argv[2]), atoi(argv[3]), atoi(argv[4]));
	}
	return -1;
}

int setLed0(int r, int g, int b){
	AllesUit();
	RGBKleur(r, g, b);
	return 0;
}

int setLed1(int r, int g, int b){
	return 1;
}

int setLed2(int r, int g, int b){
	return 2;
}

int setLed3(int r, int g, int b){
	return 3;
}

int setLed4(int r, int g, int b){
	return 4;
}

int setLed5(int r, int g, int b){
	return 5;
}

int setLed6(int r, int g, int b){
	return 6;
}

int setLed7(int r, int g, int b){
	return 7;
}

void AllesUit(void){

	for (int x = 0; x<8; x++){
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


void AllesAan(void){
	for (int x = 0; x<8; x++){
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

void AllesGroen(void){
	for (int x = 0; x<8; x++){
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

void AllesRood(void){
	for (int x = 0; x<8; x++){
		for (int y = 0; y<8; y++){
			digitalWrite(22, 0);
			digitalWrite(23, 1);
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

void AllesBlauw(void){
	for (int x = 0; x<8; x++){
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

void RGBKleur(char r, char g, char b){
	char bitwaarde = 128;
	for (int x = 0; x<8; x++){
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
	}
}


void VeranderLed(char led, char r, char g, char b){



}


void BlinkLed(void){
	digitalWrite(4, 1);
	delay(250);
	digitalWrite(4, 0);
	delay(250);
}
