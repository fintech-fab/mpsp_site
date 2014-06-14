#!/bin/sh

confid=$1
dbpass=$2
irontoken=$3
ironkey=$4
home=~

prefix="conf-$confid"
postfix="mpsp.dev"


placehoders() {
	for cf in ./*
	do
		if [ -f "$cf" ]
			then
			echo "placeholding: $cf"
			sed -e "s/#confid#/$1/g" "$cf" > tmp
			mv -f tmp "$cf"
			sed -e "s/#dbpass#/$2/g" "$cf" > tmp
			mv -f tmp "$cf"
			sed -e "s/#irontoken#/$3/g" "$cf" > tmp
			mv -f tmp "$cf"
			sed -e "s/#ironkey#/$4/g" "$cf" > tmp
			mv -f tmp "$cf"
		fi
	done
}

if [ "$1" = 'help' ]
then
	echo "\nsh deploy.sh confid dbpass irontoken ironkey"
else

	# site
	ROOT="$home/$prefix.$postfix"
	EXAMPLES="$ROOT/app/config/examples"
	CONF="$ROOT/app/config/local"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$confid" "$dbpass" "$irontoken" "$ironkey"
	cd "$ROOT"
	php artisan dump-autoload
	php artisan clear-compiled
	php artisan ide-helper:generate
	php artisan migrate:reset --database="ff-bank-em"
	php artisan migrate --package="fintech-fab/bank-emulator" --database="ff-bank-em"
	php artisan migrate:reset --database="ff-mt-em"
	php artisan migrate --package="fintech-fab/money-transfer-emulator" --database="ff-mt-em"
	# php artisan queue:listen --queue="ff-bank-em" ff-bank-em




	# api
	ROOT="$home/$prefix.api.$postfix"
	EXAMPLES="$ROOT/app/config/examples/local"
	CONF="$ROOT/app/config/local"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$confid" "$dbpass" "$irontoken" "$ironkey"
	cd "$ROOT"
	php artisan dump-autoload
	php artisan clear-compiled
	php artisan ide-helper:generate
	php artisan migrate:reset
	php artisan migrate --seed
	# php artisan queue:listen api




	# gateway
	ROOT="$home/$prefix.gateway.$postfix"
	EXAMPLES="$ROOT/app/config/examples/local"
	CONF="$ROOT/app/config/local"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$confid" "$dbpass" "$irontoken" "$ironkey"
	cd "$ROOT"
	php artisan dump-autoload
	php artisan clear-compiled
	php artisan ide-helper:generate
	# php artisan queue:listen gateway




	# gateway providers
	EXAMPLES="$ROOT/app/config/examples/local/providers"
	CONF="$ROOT/app/config/local/providers"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$confid" "$dbpass" "$irontoken" "$ironkey"
	cd "$ROOT"

fi


