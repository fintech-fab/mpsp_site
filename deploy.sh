#!/bin/sh

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
	ROOT="/var/www/conf-$1.mpsp.dev"
	EXAMPLES="$ROOT/app/config/examples"
	CONF="$ROOT/app/config/local"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$1" "$2" "$3" "$4"
	cd "$ROOT"
	php artisan dump-autoload
	php artisan migrate --package="fintech-fab/bank-emulator" --database="ff-bank-em"
	php artisan migrate --package="fintech-fab/money-transfer-emulator" --database="ff-mt-em"
	# php artisan queue:listen --queue="ff-bank-em" ff-bank-em




	# api
	ROOT="/var/www/conf-$1.api.mpsp.dev"
	EXAMPLES="$ROOT/app/config/examples/local"
	CONF="$ROOT/app/config/local"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$1" "$2" "$3" "$4"
	cd "$ROOT"
	php artisan dump-autoload
	php artisan migrate --seed
	# php artisan queue:listen api




	# gateway
	ROOT="/var/www/conf-$1.gateway.mpsp.dev"
	EXAMPLES="$ROOT/app/config/examples/local"
	CONF="$ROOT/app/config/local"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$1" "$2" "$3" "$4"
	cd "$ROOT"
	php artisan dump-autoload
	php artisan migrate --seed
	# php artisan queue:listen gateway


	# gateway providers
	EXAMPLES="$ROOT/app/config/examples/local/providers"
	CONF="$ROOT/app/config/local/providers"

	rm -rf "$CONF"
	cp -r "$EXAMPLES" "$CONF"

	cd "$CONF"
	echo "go to: $CONF"
	placehoders "$1" "$2" "$3" "$4"
	cd "$ROOT"

fi


