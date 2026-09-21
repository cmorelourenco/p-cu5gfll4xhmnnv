{{-- The pixel arrow.

     The squares between the C and the m in the wordmark are a rule, not a
     texture: equal squares, each one unit right and one unit up, touching
     corner to corner. Mirror that stair about its top and you have a
     chevron — so the arrow is the wordmark read in another direction rather
     than a new shape. Geometry, size and motion all live in arrow.css; the
     markup is three empty <b> elements taking currentColor.

     On a button it marks FORWARD. Drop it where the button does not move you
     forward (Save, Apply), and never put it on the one that cancels. --}}
@props(['size' => 'md', 'shape' => 'chev3'])
<span {{ $attributes->class(['px', 'px-' . $size, 'px-' . $shape]) }} aria-hidden="true"><b></b><b></b><b></b></span>
